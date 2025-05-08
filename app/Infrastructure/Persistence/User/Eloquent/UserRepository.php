<?php

namespace App\Infrastructure\Persistence\User\Eloquent;

use App\Domain\User\Entities\User;
use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Infrastructure\Persistence\User\Mappers\UserMapper;
use App\Infrastructure\Persistence\User\Models\UserModel;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function getAll(): Collection
    {
        return UserModel::with('profileType')->get();
    }

    public function save(User $user): void
    {
        $model = UserMapper::toModel($user);

        $model->save();
    }

    public function update(User $user): void
    {
        $model = UserModel::where("id", $user->getId()->toString())->first();

        $model->update([
            "name" => $user->getName(),
            "email" => $user->getEmail(),
            "password" => $user->getPassword()->get(),
            "updated_at" => now()
        ]);
    }

    public function find(string $id): User
    {
        /* TODO: throw exception if not found */
        $userModel = UserModel::find($id);

        return UserMapper::toDomain($userModel);
    }

    public function findByEmail(string $email): ?User
    {
        return UserModel::where("email", $email)->first();

    }

    public function emailExists(string $email): bool
    {
        return UserModel::where('email', $email)->exists();
    }

    public function exists(string $id): bool
    {
        return UserModel::find($id)->exists();
    }

}
