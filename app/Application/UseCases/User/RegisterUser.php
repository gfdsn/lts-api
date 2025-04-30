<?php

namespace App\Application\UseCases\User;

use App\Application\DTOs\UserDTO;
use App\Domain\User\Entities\User;

class RegisterUser
{
    public function execute(UserDTO $dto): void
    {
        /* Create the user object */
        $user = User::fromDto($dto);

        /* register user aka save it to database and do stuff*/
    }

}
