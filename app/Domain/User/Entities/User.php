<?php

namespace App\Domain\User\Entities;

use App\Domain\User\Entities\Profiles\AdminProfile;
use App\Domain\User\Entities\Profiles\UserProfile;
use App\Domain\User\Entities\ValueObjects\Attributes\UserEmail;
use App\Domain\User\Entities\ValueObjects\Attributes\UserId;
use App\Domain\User\Entities\ValueObjects\Attributes\UserPassword;
use App\Domain\User\Exceptions\UserException;
use Illuminate\Support\Facades\Log;
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
    public function assignProfile(UserProfile $profile, User $user): void
    {
        // check if user's profile is admin
        if (!($this->profile instanceof AdminProfile))
            throw UserException::noPermission();

        // check if target user already has a profile
        if (isset($user->profile))
            throw UserException::profileAlreadyAssigned();

        $user->profile = $profile;
    }

    /**
     * @throws UserException
     */
    public function forceAssignProfile(UserProfile $profile, User $user): void
    {
        if (app()->isProduction())
            throw UserException::productionProfileAssignation();

        Log::info("Force assigning profile: " . get_class($profile) . " for user ID: {$this->id->get()}");

        $user->profile = $profile;
    }

    public function can(string $action): bool
    {
        return $this->profile->can($action); // return if user profile has permission
    }

    /* sort of a mini DTO */
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


