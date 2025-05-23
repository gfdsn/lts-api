<?php

namespace App\Http\Controllers;

use App\Application\User\DTOs\Auth\LoginUserDTO;
use App\Application\User\UseCases\Auth\LoginUserUseCase;
use App\Domain\User\Exceptions\UserAuthException;
use App\Http\Requests\User\Auth\LoginUserRequest;
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

        return ResponseBuilder::sendData(["status" => true, "token" => $token]);
    }
}
