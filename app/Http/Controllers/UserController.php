<?php

namespace App\Http\Controllers;

use App\Application\User\DTOs\Auth\RegisterUserDTO;
use App\Application\User\DTOs\CRUD\DeleteUserDTO;
use App\Application\User\DTOs\CRUD\UpdateUserDTO;
use App\Application\User\UseCases\CRUD\DeleteUserUseCase;
use App\Application\User\UseCases\CRUD\ListAllUsersUseCase;
use App\Application\User\UseCases\CRUD\StoreUserUseCase;
use App\Application\User\UseCases\CRUD\UpdateUserUseCase;
use App\Domain\User\Exceptions\UserAuthException;
use App\Domain\User\Exceptions\UserRepositoryException;
use App\Http\Middleware\VerifyIfUserIsAdmin;
use App\Http\Middleware\VerifyUserIdentity;
use App\Http\Requests\User\CRUD\DeleteUserRequest;
use App\Http\Requests\User\CRUD\StoreUserRequest;
use App\Http\Requests\User\CRUD\UpdateUserRequest;
use App\Http\Util\ResponseBuilder;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware(VerifyUserIdentity::class)->only(['update', 'delete']);
        $this->middleware(VerifyIfUserIsAdmin::class)->only(['index']);
        $this->middleware('throttle:api');
    }

    public function index(ListAllUsersUseCase $useCase): JsonResponse
    {
        return ResponseBuilder::sendData($useCase->execute());
    }

    public function store(StoreUserRequest $request, StoreUserUseCase $useCase): JsonResponse
    {
        $validated = $request->validated();

        $dto = new RegisterUserDTO(...array_values($validated));

        $useCase->execute($dto);

        return ResponseBuilder::success("User registered successfully", 201);
    }

    /**
     * @throws UserRepositoryException
     * @throws UserAuthException
     */
    public function update(UpdateUserRequest $request, UpdateUserUseCase $useCase): JsonResponse
    {
        $validated = $request->validated();

        $dto = new UpdateUserDTO(...array_values($validated));

        $useCase->execute($dto);

        return ResponseBuilder::success("User updated successfully");
    }

    /**
     * @throws UserRepositoryException
     * @throws UserAuthException
     */
    public function delete(DeleteUserRequest $request, DeleteUserUseCase $useCase): JsonResponse
    {
        $validated = $request->validated();

        $dto = new DeleteUserDTO(...array_values($validated));

        $useCase->execute($dto);

        return ResponseBuilder::success("User deleted successfully");
    }
}
