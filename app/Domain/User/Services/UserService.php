<?php

namespace App\Domain\User\Services;

use App\Application\User\DTOs\CreateUserDTO;
use App\Application\User\DTOs\DeleteUserDTO;
use App\Application\User\DTOs\UpdateUserDTO;
use App\Domain\User\Entities\User;
use App\Domain\User\Exceptions\UserAuthException;
use App\Domain\User\Exceptions\UserRepositoryException;
use App\Infrastructure\Persistence\User\Eloquent\UserRepository;
use App\Infrastructure\Persistence\User\Mappers\UserMapper;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

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

        $user = UserMapper::fromDto($dto);

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
        $newEmail = $dto->getEmail();

        /* throw exception if the user is not found */
        if (!$this->userRepository->exists($id))
            throw UserRepositoryException::userNotFound();

        /* verify if the new password equals the new password confirmation*/
        if ($dto->getNewPassword() != $dto->getPasswordConfirmation())
            throw UserAuthException::passwordsDoNotMatch();

        $userModel = $this->userRepository->find($id);
        $user = UserMapper::toDomain($userModel);

        if($this->emailExists($newEmail) && $newEmail != $user->getEmail())
            throw UserRepositoryException::emailAlreadyExists();

        /* verify if current password is correct */
        if(!$this->verifyPassword($user, $dto->getCurrentPassword()))
            throw UserAuthException::incorrectPassword();

        /* updates the domain user */
        $user->update($dto->toUpdateArray());

        /* save user's updates in the repository */
        $this->userRepository->update($user);

        return $user;
    }

    /**
     * @throws UserAuthException
     */
    public function delete(DeleteUserDTO $dto): bool
    {
        $userModel = $this->userRepository->find($dto->getId());
        $user = UserMapper::toDomain($userModel);

        if(!$this->verifyPassword($user, $dto->getPassword()))
            throw UserAuthException::incorrectPassword();

        return $this->userRepository->destroy($dto->getId());
    }

    private function emailExists(string $email): bool
    {
        return $this->userRepository->emailExists($email);
    }
    private function verifyPassword(User $user,string $password): bool
    {
        return $user->getPassword()->check($password);
    }

}
