<?php

namespace App\Http\Controllers;

use App\Application\User\DTOs\Auth\LoginUserDTO;
use App\Application\User\DTOs\Auth\RegisterUserDTO;
use App\Application\User\UseCases\Auth\LoginUserUseCase;
use App\Application\User\UseCases\Auth\RegisterUserUseCase;
use App\Domain\User\Exceptions\UserAuthException;
use App\Domain\User\Exceptions\UserRepositoryException;
use App\Http\Requests\User\Auth\LoginUserRequest;
use App\Http\Requests\User\CRUD\StoreUserRequest;
use App\Util\ResponseBuilder;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function login(LoginUserRequest $request, LoginUserUseCase $useCase): JsonResponse
    {
        $validated = $request->validated();

        $dto = new LoginUserDTO(...array_values($validated));

        try {
            $token = $useCase->execute($dto);
        } catch (UserAuthException $e){
            return ResponseBuilder::error($e->getMessage(), 401);
        } catch (\Throwable $e){
            return ResponseBuilder::error("There was a server error, please try again later.", 500);
        }

        return ResponseBuilder::sendData(["status" => true, "message" => "User logged in successfully.", "token" => $token]);
    }

    public function register(StoreUserRequest $request, RegisterUserUseCase $useCase): JsonResponse
    {
        $validated = $request->validated();

        $dto = new RegisterUserDTO(...array_values($validated));

        try {
            $token = $useCase->execute($dto);
        } catch (UserRepositoryException $e){
            return ResponseBuilder::error("The provided email is already registered.", 409);
        } catch (\Throwable $e){
            return ResponseBuilder::error("There was a server error, please try again later.", 500);
        }

        return ResponseBuilder::sendData(["status" => true, "message" => "User registered successfully.", "token" => $token]);
    }
}
