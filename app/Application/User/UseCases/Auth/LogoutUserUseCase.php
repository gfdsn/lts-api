<?php

namespace App\Application\User\UseCases\Auth;


use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

readonly class LogoutUserUseCase
{
    public function __construct(
        private JWTAuth $jwt
    ){}


    /**
     * @throws JWTException
     */
    public function execute(): void
    {
        /*
         * get user token and invalidate it
         * */
        $this->jwt->parseToken()->invalidate(true);
    }

}
