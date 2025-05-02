<?php

namespace App\Infrastructure\Persistence\User\Mappers;

use App\Domain\User\Entities\User as DomainUser;
use App\Domain\User\Entities\ValueObjects\Attributes\UserEmail;
use App\Domain\User\Entities\ValueObjects\Attributes\UserId;
use App\Domain\User\Entities\ValueObjects\Attributes\UserName;
use App\Domain\User\Entities\ValueObjects\Attributes\UserPassword;
use App\Infrastructure\Persistence\User\Models\UserModel;

class UserMapper
{
    public static function toDomain(UserModel $user): DomainUser
    {
        return new DomainUser(
            UserId::fromString($user->id),
            new UserName($user->name),
            new UserEmail($user->email),
            new UserPassword($user->password)
        );
    }

    public static function toModel(DomainUser $user): UserModel
    {
        return new UserModel([
            'id' => $user->getId()->toString(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
        ]);
    }
}
