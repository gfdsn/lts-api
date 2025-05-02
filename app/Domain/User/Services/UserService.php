<?php

namespace App\Domain\User\Services;

use App\Application\User\DTOs\UserRegisterDTO;
use App\Domain\User\Entities\User;
use App\Domain\User\Exceptions\UserException;
use App\Infrastructure\Persistence\User\Eloquent\UserRepository;
use App\Infrastructure\Persistence\User\Mappers\UserMapper;
use Illuminate\Http\Resources\Json\ResourceCollection;
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
        $user = UserMapper::fromDto($userRegisterDTO);

        /* TODO: more validations */
        if ($this->userRepository->emailExists($user->getEmail())) {
            throw UserException::emailAlreadyExists();
        }

        $this->userRepository->save($user);

        return $user;
    }

    private function validate()
    {}
}
