<?php

namespace App\Infrastructure\Persistence\User\Eloquent;

use App\Domain\User\Entities\User;
use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Infrastructure\Persistence\User\Mappers\UserMapper;
use App\Infrastructure\Persistence\User\Models\UserModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

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
        $model = $this->find($user->getId()->toString());

        $model->update([
            "name" => $user->getName()->value(),
            "email" => $user->getEmail()->value(),
            "password" => $user->getPassword()->value(),
            "updated_at" => now()
        ]);
    }

    public function destroy(string $id): bool
    {
        $model = $this->find($id);
        return $model->delete();
    }

    public function find(string $id): UserModel
    {
        return UserModel::find($id);
    }

    public function findByEmail(string $email): ?UserModel
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
