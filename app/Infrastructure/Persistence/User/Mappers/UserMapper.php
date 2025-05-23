<?php

namespace App\Infrastructure\Persistence\User\Mappers;

use App\Application\User\DTOs\Auth\RegisterUserDTO;
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
            new UserPassword($user->password) // anti-double hashing in the constructor
        );
    }

    public static function toModel(DomainUser $user): UserModel
    {
        return new UserModel([
            'id' => $user->getId()->toString(),
            'name' => $user->getName()->value(),
            'email' => $user->getEmail()->value(),
            'password' => $user->getPassword()->value(),
        ]);
    }

    public static function fromDtoToDomain(RegisterUserDTO $dto): DomainUser
    {
        return new DomainUser(
            UserId::generate(),
            new UserName($dto->getName()),
            new UserEmail($dto->getEmail()),
            new UserPassword($dto->getPassword()),
        );
    }

}
