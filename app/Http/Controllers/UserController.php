<?php

namespace App\Http\Controllers;

use App\Application\User\DTOs\CreateUserDTO;
use App\Application\User\DTOs\UpdateUserDTO;
use App\Application\User\UseCases\ListAllUsersUseCase;
use App\Application\User\UseCases\RegisterUserUseCase;
use App\Application\User\UseCases\UpdateUserUseCase;
use App\Domain\User\Exceptions\UserAuthException;
use App\Domain\User\Exceptions\UserException;
use App\Domain\User\Exceptions\UserRepositoryException;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Util\ResponseBuilder;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index(ListAllUsersUseCase $useCase): JsonResponse
    {
        return ResponseBuilder::sendData($useCase->execute());
    }

    /**
     * @throws UserException
     */
    public function store(UserStoreRequest $request, RegisterUserUseCase $useCase): JsonResponse
    {
        $validated = $request->validated();

        $dto = new CreateUserDTO(...array_values($validated));

        $useCase->execute($dto);

        return ResponseBuilder::success("User registered successfully", 201);
    }

    /**
     * @throws UserRepositoryException
     * @throws UserAuthException
     */
    public function update(UserUpdateRequest $request, UpdateUserUseCase $useCase): JsonResponse
    {
        $validated = $request->validated();

        $dto = new UpdateUserDTO(...array_values($validated));

        $useCase->execute($dto);

        return ResponseBuilder::success("User updated successfully", 200);
    }
}
