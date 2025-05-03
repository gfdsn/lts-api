<?php

namespace App\Domain\User\Repositories;

use App\Domain\User\Entities\Profiles\UserProfile;
use Illuminate\Support\Collection;

interface ProfileTypeRepositoryInterface
{
    public function getAll(): Collection;
    public function save(string $profile): void;
    public function get(int $id): ?UserProfile;
}
