<?php

namespace App\Providers;

use App\Domain\User\Repositories\ProfileTypeRepositoryInterface;
use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Infrastructure\Persistence\User\Eloquent\ProfileTypeRepository;
use App\Infrastructure\Persistence\User\Eloquent\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            ProfileTypeRepositoryInterface::class,
            ProfileTypeRepository::class
        );
    }

    public function boot(): void
    {}

}
