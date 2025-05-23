<?php

namespace App\Providers;

use App\Domain\User\Contracts\AuthenticatorInterface;
use App\Domain\User\Repositories\ProfileTypeRepositoryInterface;
use App\Domain\User\Repositories\UserRepositoryInterface;
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
            ProfileTypeRepositoryInterface::class => ProfileTypeRepository::class,
            AuthenticatorInterface::class => Authenticator::class,
        ];

        foreach ($bindings as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    public function boot(): void
    {}

}
