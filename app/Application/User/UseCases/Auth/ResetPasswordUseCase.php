<?php

namespace App\Application\User\UseCases\Auth;

use App\Application\User\DTOs\Auth\ResetPasswordDTO;
use App\Domain\User\Exceptions\UserRepositoryException;
use App\Domain\User\Interfaces\AuthServiceInterface;
use App\Domain\User\Interfaces\UserServiceInterface;
use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Mail\ForgotPasswordEmail;
use App\Mail\ResetPasswordEmail;
use Illuminate\Support\Facades\Mail;

readonly class ResetPasswordUseCase
{

    public function __construct(
        private UserServiceInterface  $userService,
        private AuthServiceInterface $authService,
        private UserRepositoryInterface $userRepository
    ){}

    /**
     * @throws UserRepositoryException
     */
    public function execute(ResetPasswordDTO $dto): void
    {
        $email = $dto->getEmail();

        // the verification that checks if the user exists is also in the request
        // "never trust foreign places"
        if (!$this->userService->emailExists($email))
            throw UserRepositoryException::userNotFound();

        $token = $dto->getToken();
        $password = $dto->getPassword();

        $this->authService->resetPassword($email,$token, $password);

        $name = $this->userRepository->findByEmail($email)->first_name;

        Mail::to($email)->send(new ResetPasswordEmail($name));
    }

}
