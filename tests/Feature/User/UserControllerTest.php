<?php

namespace Tests\Feature\User;

use App\Domain\User\Entities\ValueObjects\Attributes\UserId;
use App\Infrastructure\Persistence\User\Eloquent\UserRepository;
use App\Infrastructure\Persistence\User\Models\UserModel;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function test_index_returns_all_users(): void
    {
        $repo = \Mockery::mock(UserRepository::class);
        $this->app->instance(UserRepository::class, $repo);

        /* test users */
        $fakeUsers = collect([
            new UserModel(["id" => UserId::generate(),  "name" => "Guilherme", "email" => "guilherme@santos.pt", "password" => "123456789A."]),
            new UserModel(["id" => UserId::generate(),  "name" => "João", "email" => "joao@lopes.pt", "password" => "123456789A."]),
        ]);

        $repo->shouldReceive('getAll')
            ->once()
            ->andReturn($fakeUsers);

        $repo->shouldReceive('first')
            ->andReturn(null);

        $response = $this->get('/api/user');

        $response->assertStatus(200);

        /* get the retrieved users */
        $users = $response->json();

        /* check if the endpoint returned an array*/
        $this->assertIsArray($users);

        /* check if each of the elements, as it should*/
        foreach ($users as $user) {
            $this->assertArrayHasKey('id', $user);
            $this->assertArrayHasKey('name', $user);
        }
    }

    public function test_user_is_saved_to_db(): void
    {
        /* mock the db so it doesn't actually save the user */
        $repo = \Mockery::mock(UserRepository::class);
        $this->app->instance(UserRepository::class, $repo);

        $repo->shouldReceive('emailExists')
            ->once()
            ->with('guilherme@santos.pt')
            ->andReturn(false);

        $repo->shouldReceive('save')
            ->once()
            ->andReturnUsing(function ($user) {
                /* test if the user was actually saved to the db*/
                $this->assertEquals('Guilherme', $user->getName()->value());
                $this->assertEquals('guilherme@santos.pt', $user->getEmail()->value());
            });

        /* send the request with an example payload */
        $response = $this->postJson('/api/user', [
            "name" => "Guilherme",
            "email" => "guilherme@santos.pt",
            "password" => "12345678A.",
            "password_confirmation" => "12345678A."
        ]);

        /* test if the status code returned is 201 (CREATED) */
        $response->assertStatus(201);

        /* verify the response content */
        $response->assertJson(["status" => true, "message" => "User registered successfully"]);
    }
}
