<?php

namespace App\Domain\User\Entities;

use App\Domain\User\Entities\Profiles\AdminProfile;
use App\Domain\User\Entities\Profiles\IndividualProfile;
use App\Domain\User\Entities\Profiles\UserProfile;
use App\Domain\User\Entities\ValueObjects\Attributes\UserEmail;
use App\Domain\User\Entities\ValueObjects\Attributes\UserId;
use App\Domain\User\Entities\ValueObjects\Attributes\UserName;
use App\Domain\User\Entities\ValueObjects\Attributes\UserPassword;
use App\Domain\User\Exceptions\UserException;
use Illuminate\Support\Facades\Log;

class User implements \JsonSerializable
{

    private ?UserProfile $profile;

    public function __construct(
        public readonly UserId $id,
        public UserName $name,
        public UserEmail $email,
        public UserPassword $password
    ) {
        // By default, users should be Individual
        $this->profile = new IndividualProfile();
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    public function getName(): UserName
    {
        return $this->name;
    }

    private function updateName(string $newName): void
    {
        $this->name = new UserName($newName);
    }

    public function getEmail(): UserEmail
    {
        return $this->email;
    }

    private function updateEmail(string $newEmail): void
    {
        $this->email = new UserEmail($newEmail);
    }

    public function getPassword(): UserPassword
    {
        return $this->password;
    }

    private function updatePassword(string $newPassword): void
    {
        $this->password = new UserPassword($newPassword);
    }

    public function getProfile(): UserProfile
    {
        return $this->profile;
    }

    public function getProfileType(): string
    {
        return $this->profile->getType();
    }

    public function update(array $payload): void
    {
        +
        $this->updateName($payload['name']);
        $this->updateEmail($payload['email']);
        $this->updatePassword($payload['password']);
    }

    /**
     * @throws UserException
     * */
    public function assignProfile(UserProfile $profile, User $user): void
    {
        // check if user's profile is admin
        if (!($this->profile instanceof AdminProfile))
            throw UserException::noPermission();

        $user->profile = $profile;
    }

    /**
     * @throws UserException
     */
    public function forceAssignProfile(UserProfile $profile, User $user): void
    {
        if (app()->isProduction()) // should only work outside of production, for test purposes
            throw UserException::productionProfileAssignation();

        Log::info("Force assigning profile: " . get_class($profile) . " for user ID: {$this->id->toString()}");

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

    public function toString(): string
    {
        return "[id: $this->id, name: $this->name, email: $this->email]";
    }
}


