<?php

namespace App\Application\User\UseCases\CRUD;

use App\Domain\User\Services\UserService;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

readonly class ListAllUsersUseCase
{

    public function __construct(
        private UserService $userService
    ) {}

    public function execute(): ResourceCollection
    {
        return UserResource::collection($this->userService->getAll());
    }

}
