<?php

namespace App\Domain\User\Entities;

use App\Domain\User\Entities\Profiles\AdminProfile;
use App\Domain\User\Entities\Profiles\UserProfile;
use App\Domain\User\Entities\ValueObjects\Attributes\UserEmail;
use App\Domain\User\Entities\ValueObjects\Attributes\UserId;
use App\Domain\User\Entities\ValueObjects\Attributes\UserPassword;
use App\Domain\User\Exceptions\UserException;
use Exception;

class User implements \JsonSerializable
{
    private ?UserProfile $profile = null;

    public function __construct(
        public readonly UserId $id,
        public readonly string $name,
        public readonly UserEmail $email,
        public readonly UserPassword $password
    ) {}

    public function getId(): UserId
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getProfile(): UserProfile|null
    {
        return $this->profile;
    }

    public function getProfileType(): string
    {
        return $this->profile->getType();
    }

    /**
     * @throws Exception
     * */
    public function assignProfile(UserProfile $profile): void
    {
        // check if user's profile is admin
        if (!(auth()->user->profile instanceof AdminProfile))
            throw UserException::noPermission();

        // check if target user already has a profile
        if (isset($this->profile))
            throw UserException::profileAlreadyAssigned();

        $this->profile = $profile;
    }


    public function can(string $action): bool
    {
        return $this->profile->can($action); // return if user profile has permission
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
        ];

    }

    /* work on this*/
    public function toString(): string
    {
        $userid = $this->id->get();
        return "$userid, $this->name";
    }
}


