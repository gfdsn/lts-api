<?php

namespace Domain\User;

use App\Application\User\DTOs\UpdateUserDTO;
use App\Domain\User\Entities\User;
use App\Domain\User\Entities\ValueObjects\Attributes\UserEmail;
use App\Domain\User\Entities\ValueObjects\Attributes\UserId;
use App\Domain\User\Entities\ValueObjects\Attributes\UserName;
use App\Domain\User\Entities\ValueObjects\Attributes\UserPassword;
use App\Domain\User\Services\UserService;
use App\Infrastructure\Persistence\User\Eloquent\UserRepository;
use Tests\TestCase;

class UserUpdateTest extends TestCase
{

    public function test_user_can_be_updated(): void
    {
        /* mock the database */
        $repo = \Mockery::mock(UserRepository::class);
        $this->app->instance(UserRepository::class, $repo);

        /* create an example user to be updated */
        $userId = UserId::generate();

        $user = new User(
            $userId,
            new UserName("User"),
            new UserEmail('user@user.pt'),
            new UserPassword("12345678.A")
        );

        /* service should receive a UpdateUserDTO */
        $dto = new UpdateUserDTO(
            $userId->toString(),
            "User Updated",
            "user_updated@user.pt",
            "12345678.A",
            "12345678.ABC",
            "12345678.ABC"
        );

        $repo->shouldReceive('exists')
            ->andReturn(True)
            ->once();

        $repo->shouldReceive('find')
            ->andReturn($user)
            ->once();

        $repo->shouldReceive('update')
            ->once();

        /* inject the user service*/
        $service = app(UserService::class);

        $updatedUser = $service->update($dto);

        /* test if the returned user is updated */
        $this->assertEquals($dto->getId(), $updatedUser->getId()->toString());
        $this->assertEquals($dto->getName(), $updatedUser->getName());
        $this->assertEquals($dto->getEmail(), $updatedUser->getEmail());
        $this->assertTrue($updatedUser->getPassword()->check($dto->getNewPassword()));

    }
}
