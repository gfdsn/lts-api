<?php

namespace Tests\Unit\Domain\User;

use App\Domain\User\Entities\Profiles\AdminProfile;
use App\Domain\User\Entities\Profiles\IndividualProfile;
use App\Domain\User\Entities\User;
use App\Domain\User\Entities\ValueObjects\Attributes\UserEmail;
use App\Domain\User\Entities\ValueObjects\Attributes\UserId;
use App\Domain\User\Entities\ValueObjects\Attributes\UserName;
use App\Domain\User\Entities\ValueObjects\Attributes\UserPassword;
use App\Domain\User\Enums\UserProfileType;
use App\Domain\User\Exceptions\UserException;
use Tests\TestCase;

class UserCreationTest extends TestCase
{
    public function test_user_domain_object_creation_test(): void
    {
        $user = new User(
            UserId::fromString("888fa974-50d0-43f8-b0c4-d28385c852d1"),
            new UserName("User"),
            new UserEmail('user@user.pt'),
            new UserPassword("12345678.A")
        );

        /* id verification */
        $this->assertTrue($user->getId()->equals("888fa974-50d0-43f8-b0c4-d28385c852d1"));
        $this->assertFalse($user->getId()->equals("888fa974-50d0-43f7-b0c4-d28385c852d1"));

        /* user name verification */
        $this->assertEquals('User', $user->getName()->value());

        /* user profile set as individual by default */
        $this->assertEquals("individual", $user->getProfileType());
    }

    /**
     * @throws \Exception
     */
    public function test_admin_can_assign_profile_to_user(): void
    {
        $admin = new User(UserId::generate(), new UserName("Admin"), new UserEmail('admin@admin.pt'), new UserPassword("12345678.A"));
        /* set admins profile as Admin */
        $admin->forceAssignProfile(new AdminProfile(), $admin);

        /* test if the profile was set */
        $this->assertEquals($admin->getProfileType(), UserProfileType::ADMIN->value);

        /* test if admin has permission to assign profile */
        $this->assertTrue($admin->can("assign_profile"));
    }

    /**
     * @throws \Exception
     */
    public function test_individual_can_assign_profile_to_user(): void
    {
        $admin = new User(UserId::generate(), new UserName("Admin"), new UserEmail('admin@admin.pt'), new UserPassword("12345678.A"));
        $admin->forceAssignProfile(new AdminProfile(), $admin);

        $user = new User(UserId::generate(), new UserName('Example User'), new UserEmail('user@user.pt'), new UserPassword("12345678.A"));
        $admin->assignProfile(new IndividualProfile(), $user);

        /* test if the user's profile was set */
        $this->assertEquals($user->getProfileType(), UserProfileType::INDIVIDUAL->value);

        /* test if normal users(individual/enterprise) has permission to set profiles */
        $this->assertFalse($user->can("assign_profile"));

        $this->expectException(UserException::class);
        $this->expectExceptionMessage("a");
        $user->assignProfile(new AdminProfile(), $user);
    }

}
