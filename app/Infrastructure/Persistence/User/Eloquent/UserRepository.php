<?php

namespace App\Infrastructure\Persistence\User\Eloquent;

use App\Domain\User\Entities\User;
use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Http\Resources\UserResource;
use App\Infrastructure\Persistence\User\Mappers\UserMapper;
use App\Infrastructure\Persistence\User\Models\UserModel;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{

    public function getAll(): Collection
    {
        return UserModel::all();
    }

    /* saves the new user to the database */
    public function save(User $user): void
    {
        $model = UserMapper::toModel($user);

        $model->save();
    }

    public function emailExists(string $email): bool
    {
        return UserModel::where('email', $email)->exists();
    }


   /* public function find(UserId $id): ?User
    {
        // TODO: Implement find() method.
    }

    public function findByEmail(string $email): ?User
    {
        // TODO: Implement findByEmail() method.
    }*/

}
