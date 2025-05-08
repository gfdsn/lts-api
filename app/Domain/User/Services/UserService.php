<?php

namespace App\Domain\User\Services;

use App\Application\User\DTOs\CreateUserDTO;
use App\Application\User\DTOs\UpdateUserDTO;
use App\Domain\User\Entities\User;
use App\Domain\User\Entities\ValueObjects\Attributes\UserPassword;
use App\Domain\User\Exceptions\UserAuthException;
use App\Domain\User\Exceptions\UserException;
use App\Domain\User\Exceptions\UserRepositoryException;
use App\Infrastructure\Persistence\User\Eloquent\UserRepository;
use App\Infrastructure\Persistence\User\Mappers\UserMapper;
use Illuminate\Support\Collection;

readonly class UserService
{

    public function __construct(
        private UserRepository $userRepository
    ) {}

    public function getAll(): Collection
    {
        return $this->userRepository->getAll();
    }

    /**
     * @throws UserAuthException
     * @throws UserRepositoryException
     */
    public function register(CreateUserDTO $dto): User
    {
        if($this->emailExists($dto->getEmail()))
            throw UserRepositoryException::emailAlreadyExists();

        if ($dto->getPassword() != $dto->getPasswordConfirmation())
            throw UserAuthException::passwordsDoNotMatch();

        $user = UserMapper::fromCreateDto($dto);

        $this->userRepository->save($user);

        return $user;
    }

    /**
     * @throws UserRepositoryException
     * @throws UserAuthException
     */
    public function update(UpdateUserDTO $dto): User
    {
        $id = $dto->getId();

        /* throw exception if the user is not found */
        if (!$this->userRepository->exists($id))
            throw UserRepositoryException::userNotFound();

        /* verify if the new password equals the new password confirmation*/
        if ($dto->getNewPassword() != $dto->getPasswordConfirmation())
            throw UserAuthException::passwordsDoNotMatch();

        $user = $this->userRepository->find($id);

        /* verify if current password is correct */
        if (!$user->getPassword()->check($dto->getCurrentPassword()))
            throw UserAuthException::incorrectPassword();

        $newUserDataPayload = [
            "name" => $dto->getName(),
            "email" => $dto->getEmail(),
            "password" => $dto->getNewPassword()
        ];

        /* updates the domain user */
        $user->update($newUserDataPayload);

        /* save user's updates in the repository */
        $this->userRepository->update($user);

        return $user;
    }

    private function emailExists(string $email): bool
    {
        return $this->userRepository->emailExists($email);
    }

}
