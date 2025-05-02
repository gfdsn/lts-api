<?php

namespace App\Domain\User\Entities;

use App\Application\DTOs\UserRegisterDTO;
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
        public readonly UserName $name,
        public readonly UserEmail $email,
        public readonly UserPassword $password
    ) {
        // By default, users should be Individual
        $this->profile = new IndividualProfile();
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name->get();
    }

    public function getEmail(): string
    {
        return $this->email->get();
    }

    public function getPassword(): string
    {
        return $this->password->get();
    }

    public function getProfile(): UserProfile
    {
        return $this->profile;
    }

    public function getProfileType(): string
    {
        return $this->profile->getType();
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
        if (app()->isProduction())
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
        $userid = $this->id->get();
        return "[id: $userid, name: $this->name, email: $this->email]";
    }

    public static function fromDto(UserRegisterDTO $dto): User
    {
        return new self(
            UserId::generate(),
            new UserName($dto->getName()),
            new UserEmail($dto->getEmail()),
            new UserPassword($dto->getPassword())
        );
    }

}


