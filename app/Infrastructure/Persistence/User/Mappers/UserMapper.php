<?php

namespace App\Infrastructure\Persistence\User\Mappers;

use App\Application\User\DTOs\CreateUserDTO;
use App\Application\User\DTOs\UpdateUserDTO;
use App\Domain\User\Entities\User;
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
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword()->get(),
        ]);
    }

    public static function fromCreateDto(CreateUserDTO $dto): User
    {
        return new User(
            UserId::generate(),
            new UserName($dto->getName()),
            new UserEmail($dto->getEmail()),
            new UserPassword($dto->getPassword())
        );
    }

    public static function fromUpdateDto(UpdateUserDTO $dto): User
    {
        return new User(
            UserId::generate(),
            new UserName($dto->getName()),
            new UserEmail($dto->getEmail()),
            new UserPassword($dto->getNewPassword())
        );
    }
}
