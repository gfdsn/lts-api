<?php

namespace App\Domain\User\Services;

use App\Application\DTOs\UserRegisterDTO;
use App\Domain\User\Entities\User;
use App\Domain\User\Exceptions\UserException;
use App\Infrastructure\Persistence\User\Eloquent\UserRepository;
use Illuminate\Support\Collection;

class UserService
{

    public function __construct(
        private UserRepository $userRepository
    ) {}

    public function getAll(): Collection
    {
        return $this->userRepository->getAll();
    }

    /**
     * @throws UserException
     */
    public function register(UserRegisterDTO $userRegisterDTO): User
    {
        $user = User::fromDto($userRegisterDTO);

        /* more validations */
        if ($this->userRepository->emailExists($user->getEmail())) {
            throw UserException::emailAlreadyExists();
        }

        $this->userRepository->save($user);

        return $user;
    }

    private function validate()
    {}
}
