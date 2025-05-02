<?php

namespace App\Application\UseCases\User;

use App\Domain\User\Services\UserService;
use Illuminate\Support\Collection;

readonly class ListAllUsersUseCase
{

    public function __construct(
        private UserService $userService
    ) {}

    public function execute(): Collection
    {
        return $this->userService->getAll();
    }

}
