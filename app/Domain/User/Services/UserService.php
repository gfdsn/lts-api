<?php

namespace App\Domain\User\Services;

use App\Application\User\DTOs\Auth\RegisterUserDTO;
use App\Application\User\DTOs\CRUD\CreateUserDTO;
use App\Application\User\DTOs\CRUD\DeleteUserDTO;
use App\Application\User\DTOs\CRUD\UpdateUserDTO;
use App\Domain\User\Entities\User;
use App\Domain\User\Events\UserRegistered;
use App\Domain\User\Exceptions\UserAuthException;
use App\Domain\User\Exceptions\UserRepositoryException;
use App\Domain\User\Interfaces\UserServiceInterface;
use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Infrastructure\Persistence\User\Eloquent\UserRepository;
use App\Infrastructure\Persistence\User\Mappers\UserMapper;
use App\Infrastructure\Persistence\User\Models\UserModel;
use Carbon\Carbon;
use Illuminate\Support\Collection;

readonly class UserService implements UserServiceInterface
{

    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    public function getAll(): Collection
    {
        return $this->userRepository->getAll();
    }

    public function find(string $id): UserModel
    {
        return $this->userRepository->find($id);
    }

    public function register(RegisterUserDTO $dto): User
    {
        $user = UserMapper::fromDtoToDomain($dto);

        /* TODO: in production remember to use a queue worker process */
        event(new UserRegistered(UserMapper::toModel($user)));

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

        $userModel = $this->userRepository->find($id);
        $user = UserMapper::toDomain($userModel);

        if($this->emailExists($newEmail) && $newEmail != $user->getEmail()->value())
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

    public function emailExists(string $email): bool
    {
        return $this->userRepository->emailExists($email);
    }

    private function verifyPassword(User $user,string $password): bool
    {
        return $user->getPassword()->check($password);
    }

    public function monthlyStats(): array
    {
        $totalUsers = count($this->userRepository->getAll());
        $monthlyUsers = count($this->userRepository->monthlyUsers(Carbon::now()->month));
        $lastMonthTotalUsers = count($this->userRepository->monthlyUsers(Carbon::now()->subMonth()->month));

        $percentage = $lastMonthTotalUsers > 0 ? ($monthlyUsers / $lastMonthTotalUsers) * 100 : 0;

        return [
            "totalUsers" => $totalUsers,
            "monthlyUsersCount" => $monthlyUsers,
            "monthlyIncreasePercentage" => number_format($percentage, 1, ".", ",")
        ];
    }
}
