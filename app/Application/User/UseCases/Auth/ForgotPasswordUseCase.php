<?php

namespace App\Application\User\UseCases\Auth;

use App\Application\User\DTOs\Auth\ForgotPasswordDTO;
use App\Domain\User\Interfaces\AuthServiceInterface;
use App\Domain\User\Interfaces\UserServiceInterface;
use App\Mail\ForgotPasswordEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

readonly class ForgotPasswordUseCase
{

    public function __construct(
        private UserServiceInterface $userService,
        private AuthServiceInterface $authService,
    ) {}


    public function execute(ForgotPasswordDTO $dto): void
    {

        $email = $dto->getEmail();

        if ($this->userService->emailExists($email)) {

            $key = Str::random(60);

            /* save the key to the db */
            $this->authService->saveResetToken($email, $key);

            /* sending the email */
            Mail::to($email)->send(new ForgotPasswordEmail($email, $key));
        }
    }
}
