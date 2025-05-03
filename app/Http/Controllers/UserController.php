<?php

namespace App\Http\Controllers;

use App\Application\User\DTOs\UserRegisterDTO;
use App\Application\User\UseCases\ListAllUsersUseCase;
use App\Application\User\UseCases\RegisterUserUseCase;
use App\Domain\User\Exceptions\UserException;
use App\Http\Requests\UserStoreRequest;
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

        $userPayload = new UserRegisterDTO(
            $validated['name'],
            $validated['email'],
            $validated['password']
        );

        $useCase->execute($userPayload);

        return ResponseBuilder::success("User registered successfully", 201);
    }
}
