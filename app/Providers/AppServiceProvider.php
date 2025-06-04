<?php

namespace App\Providers;

use App\Domain\User\Contracts\AuthenticatorInterface;
use App\Domain\User\Interfaces\AuthServiceInterface;
use App\Domain\User\Interfaces\TokenServiceInterface;
use App\Domain\User\Interfaces\UserServiceInterface;
use App\Domain\User\Repositories\ProfileTypeRepositoryInterface;
use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Domain\User\Services\AuthService;
use App\Domain\User\Services\TokenService;
use App\Domain\User\Services\UserService;
use App\Infrastructure\Persistence\User\Auth\Authenticator;
use App\Infrastructure\Persistence\User\Eloquent\ProfileTypeRepository;
use App\Infrastructure\Persistence\User\Eloquent\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $bindings = [
            UserRepositoryInterface::class => UserRepository::class,
            UserServiceInterface::class => UserService::class,
            TokenServiceInterface::class => TokenService::class,
            ProfileTypeRepositoryInterface::class => ProfileTypeRepository::class,
            AuthServiceInterface::class => AuthService::class,
            AuthenticatorInterface::class => Authenticator::class,
        ];

        foreach ($bindings as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    public function boot(): void
    {}

}
