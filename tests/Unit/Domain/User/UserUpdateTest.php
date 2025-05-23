<?php

namespace Domain\User;

use App\Application\User\DTOs\CRUD\UpdateUserDTO;
use App\Domain\User\Entities\ValueObjects\Attributes\UserId;
use App\Domain\User\Interfaces\UserServiceInterface;
use App\Infrastructure\Persistence\User\Eloquent\UserRepository;
use App\Infrastructure\Persistence\User\Models\UserModel;
use Illuminate\Support\Facades\Hash;
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

        $user = new UserModel([
            "id" => $userId->toString(),
            "name" => "User",
            "email" => 'user@user.pt',
            "password" => Hash::make("12345678.A")
        ]);

        /* service should receive a UpdateUserDTO */
        $dto = new UpdateUserDTO(
            $userId->toString(),
            "User Updated",
            "user_updated@user.pt",
            "12345678.A",
            "12345678.ABC",
            "12345678.ABC"
        );

        $repo->shouldReceive('find')
            ->with($userId->toString())
            ->andReturn($user)
            ->once();

        $repo->shouldReceive('emailExists')
            ->with($dto->getEmail())
            ->andReturn(False);

        $repo->shouldReceive('update')
            ->once();

        /* inject the user service*/
        $service = app(UserServiceInterface::class);

        $updatedUser = $service->update($dto);

        /* test if the returned user is updated */
        $this->assertEquals($dto->getId(), $updatedUser->getId()->toString());
        $this->assertEquals($dto->getName(), $updatedUser->getName()->value());
        $this->assertEquals($dto->getEmail(), $updatedUser->getEmail()->value());
        $this->assertTrue($updatedUser->getPassword()->check($dto->getNewPassword()));

    }
}
