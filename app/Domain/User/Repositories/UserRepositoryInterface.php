<?php

namespace App\Domain\User\Repositories;

use App\Domain\User\Entities\User;
use App\Domain\User\Entities\ValueObjects\Attributes\UserId;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{

    public function getAll(): Collection;
    public function save(User $user): void; // save a user to the db
    /*public function find(UserId $id): ?User; // find a user by its id
    public function findByEmail(string $email): ?User; // find a user by its email*/

}
