<?php

namespace App\Http\Controllers;

use App\Application\User\DTOs\Auth\ForgotPasswordDTO;
use App\Application\User\DTOs\Auth\LoginUserDTO;
use App\Application\User\DTOs\Auth\RegisterUserDTO;
use App\Application\User\DTOs\Auth\ResetPasswordDTO;
use App\Application\User\UseCases\Auth\CheckUserSessionUseCase;
use App\Application\User\UseCases\Auth\ForgotPasswordUseCase;
use App\Application\User\UseCases\Auth\LoginUserUseCase;
use App\Application\User\UseCases\Auth\LogoutUserUseCase;
use App\Application\User\UseCases\Auth\RegisterUserUseCase;
use App\Application\User\UseCases\Auth\ResetPasswordUseCase;
use App\Domain\User\Exceptions\UserAuthException;
use App\Domain\User\Exceptions\UserRepositoryException;
use App\Http\Requests\User\Auth\ForgotPasswordRequest;
use App\Http\Requests\User\Auth\LoginUserRequest;
use App\Http\Requests\User\Auth\LogoutUserRequest;
use App\Http\Requests\User\Auth\ResetPasswordRequest;
use App\Http\Requests\User\CheckUserSessionRequest;
use App\Http\Requests\User\CRUD\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Util\ResponseBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->only('logout');
        $this->middleware('throttle:api')->except('logout');
    }

    public function login(LoginUserRequest $request, LoginUserUseCase $useCase): JsonResponse
    {
        $validated = $request->validated();

        $dto = new LoginUserDTO(...array_values($validated));

        try {
            $data = $useCase->execute($dto);

            return ResponseBuilder::sendTokenAsCookie(new UserResource($data["user"]), $data["token"]);
        } catch (UserAuthException $e){
            $errorDetails = ["ip" => $request->ip(), "email" => $validated["email"], "error" => $e->getMessage()];
            Log::channel('failed_logins')->warning('There was a failed attempt to login with the following details: '.json_encode($errorDetails));

            return ResponseBuilder::error("There was a server error, please try again later.", 500);
        } catch (\Throwable $e){
            return ResponseBuilder::error("There was a server error, please try again later.", 500);
        }
    }

    public function register(StoreUserRequest $request, RegisterUserUseCase $useCase): JsonResponse
    {
        $validated = $request->validated();

        $dto = new RegisterUserDTO(...array_values($validated));

        try {
            $token = $useCase->execute($dto);

            return ResponseBuilder::sendTokenAsCookie("User registered successfully.", $token); // TODO: fix this
        } catch (UserRepositoryException $e){
            return ResponseBuilder::error($e->getMessage(), 409);
        } catch (\Throwable $e){
           return ResponseBuilder::error("There was a server error, please try again later.", 500);
        }
    }

    public function logout(LogoutUserRequest $request, LogoutUserUseCase $useCase): JsonResponse
    {
        try{
            $useCase->execute();

            $token = $request->cookie("token");
            return ResponseBuilder::sendLogoutTokenAsCookie($token, -1); // telling the browser to delete the cookie
        } catch (\Throwable $e) {
            return ResponseBuilder::error("There was a server error, please try again later.", 500);
        }
    }

    public function forgotPassword(ForgotPasswordRequest $request, ForgotPasswordUseCase $useCase): JsonResponse
    {

        $validated = $request->validated();

        $dto = new ForgotPasswordDTO(...array_values($validated));

        try {
            $useCase->execute($dto);

            return ResponseBuilder::success("Notification sent successfully.");
        } catch (\Throwable $e) {
            return ResponseBuilder::error("There was a server error, please try again later.", 500);
        }
    }

    public function resetPassword(ResetPasswordRequest $request, ResetPasswordUseCase $useCase): JsonResponse
    {

        /* TODO: reset tokens should expire */

        $validated = $request->validated();
        $dto = new ResetPasswordDTO(...array_values($validated));

        try {
            $useCase->execute($dto);

            return ResponseBuilder::success("Password was reset successfully.");
        } catch (UserAuthException $e) {
            return ResponseBuilder::error($e->getMessage());
        } catch (UserRepositoryException $e){
            return ResponseBuilder::error($e->getMessage(), 404);
        } catch (\Throwable $e) {
            return ResponseBuilder::error($e->getMessage(), 500);
           /* return ResponseBuilder::error("There was a server error, please try again later.", 500); */
        }

    }

    /* check user session */
    public function me(CheckUserSessionRequest $request, CheckUserSessionUseCase $useCase): JsonResponse
    {
        if (!Auth::check()) return ResponseBuilder::sendData(['status' => false, 'message' => "Unauthenticated."]);

        $user = Auth::user();

        return ResponseBuilder::sendData(['status' => true, 'user' => new UserResource($user)]);
    }
}
