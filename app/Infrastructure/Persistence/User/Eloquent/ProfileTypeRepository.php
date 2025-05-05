<?php

namespace App\Infrastructure\Persistence\User\Eloquent;

use App\Domain\User\Entities\Profiles\UserProfile;
use App\Domain\User\Repositories\ProfileTypeRepositoryInterface;
use App\Infrastructure\Persistence\User\Mappers\ProfileTypeMapper;
use App\Infrastructure\Persistence\User\Models\ProfileTypeModel;
use Illuminate\Support\Collection;

class ProfileTypeRepository implements ProfileTypeRepositoryInterface
{
    public function getAll(): Collection
    {
        return ProfileTypeModel::all();
    }

    public function save(string $profile): void
    {
        $model = ProfileTypeMapper::toModel($profile);

        $model->save();
    }

    public function get(int $id): UserProfile
    {
        /* get profile from database */
        $profile = ProfileTypeModel::find($id)->first();

        /* map to domain model */
        return ProfileTypeMapper::toDomain($profile);
    }
}
