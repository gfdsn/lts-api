<?php

namespace App\Domain\User\Entities\ValueObjects;

final class Permissions
{
    public function __construct(
        private readonly array $perms
    ) {}

    public function getAll(): array
    {
        return [...$this->perms]; // returns a copy of the perms array
    }

    public function has(string $permission): bool
    {
        return in_array($permission, $this->perms);
    }
}
