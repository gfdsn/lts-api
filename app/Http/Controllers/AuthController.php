<?php

namespace App\Http\Controllers;

use App\Application\User\DTOs\Auth\LoginUserDTO;
use App\Application\User\DTOs\Auth\RegisterUserDTO;
use App\Application\User\UseCases\Auth\LoginUserUseCase;
use App\Application\User\UseCases\Auth\LogoutUserUseCase;
use App\Application\User\UseCases\Auth\RegisterUserUseCase;
use App\Domain\User\Exceptions\UserAuthException;
use App\Domain\User\Exceptions\UserRepositoryException;
use App\Http\Requests\User\Auth\LoginUserRequest;
use App\Http\Requests\User\Auth\LogoutUserRequest;
use App\Http\Requests\User\CRUD\StoreUserRequest;
use App\Http\Util\ResponseBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('throttle:api')->except('logout');
    }

    public function login(LoginUserRequest $request, LoginUserUseCase $useCase): JsonResponse
    {
        $validated = $request->validated();

        $dto = new LoginUserDTO(...array_values($validated));

        try {
            $token = $useCase->execute($dto);

        } catch (UserAuthException $e){
            $errorDetails = ["ip" => $request->ip(), "email" => $validated["email"], "error" => $e->getMessage()];
            Log::channel('failed_logins')->warning('There was a failed attempt to login with the following details: '.json_encode($errorDetails));

            return ResponseBuilder::error($e->getMessage(), 401);
        } catch (\Throwable $e){
            return ResponseBuilder::error("There was a server error, please try again later.", 500);
        }

        return ResponseBuilder::sendTokenAsCookie("User logged in successfully.", $token);
    }

    public function register(StoreUserRequest $request, RegisterUserUseCase $useCase): JsonResponse
    {
        $validated = $request->validated();

        $dto = new RegisterUserDTO(...array_values($validated));

        try {
            $token = $useCase->execute($dto);
        } catch (UserRepositoryException $e){
            return ResponseBuilder::error($e->getMessage(), 409);
        } catch (\Throwable $e){
            return ResponseBuilder::error($e->getMessage(), 500);

           /* return ResponseBuilder::error("There was a server error, please try again later.", 500); */
        }

        return ResponseBuilder::sendTokenAsCookie("User registered successfully.", $token);
    }

    public function logout(LogoutUserRequest $request, LogoutUserUseCase $useCase): JsonResponse
    {
        $token = $request->cookie("token");
        if ($token) {
            try{
                $useCase->execute();

                return ResponseBuilder::sendTokenAsCookie("User logged out successfully.", $token, -1); // telling the browser to delete the cookie
            } catch (\Throwable $e) {
                return ResponseBuilder::error("There was a server error, please try again later.", 500);
            }
        } else {
            return ResponseBuilder::error("The token is missing.");
        }
    }

    public function forgotPassword(): JsonResponse
    {

    }
}
