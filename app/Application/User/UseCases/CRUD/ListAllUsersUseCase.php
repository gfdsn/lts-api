<?php

namespace App\Application\User\UseCases\CRUD;

use App\Domain\User\Interfaces\UserServiceInterface;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

readonly class ListAllUsersUseCase
{

    public function __construct(
        private UserServiceInterface $userService
    ) {}

    public function execute(): ResourceCollection
    {
        return UserResource::collection($this->userService->getAll());
    }

}
