<?php

namespace App\Providers;

use App\Domain\Product\Interfaces\CategoryServiceInterface;
use App\Domain\Product\Interfaces\ProductServiceInterface;
use App\Domain\Product\Repositories\CategoryRepositoryInterface;
use App\Domain\Product\Repositories\ProductRepositoryInterface;
use App\Domain\Product\Services\CategoryService;
use App\Domain\Product\Services\ProductService;
use App\Domain\User\Contracts\AuthenticatorInterface;
use App\Domain\User\Interfaces\AuthServiceInterface;
use App\Domain\User\Interfaces\TokenServiceInterface;
use App\Domain\User\Interfaces\UserServiceInterface;
use App\Domain\User\Repositories\ProfileTypeRepositoryInterface;
use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Domain\User\Services\AuthService;
use App\Domain\User\Services\TokenService;
use App\Domain\User\Services\UserService;
use App\Infrastructure\Persistence\Product\Eloquent\CategoryRepository;
use App\Infrastructure\Persistence\Product\Eloquent\ProductRepository;
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
            AuthenticatorInterface::class => Authenticator::class,
            ProductServiceInterface::class => ProductService::class,
            ProductRepositoryInterface::class => ProductRepository::class,
            CategoryServiceInterface::class => CategoryService::class,
            CategoryRepositoryInterface::class => CategoryRepository::class,
            AuthServiceInterface::class => AuthService::class,
        ];

        foreach ($bindings as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    public function boot(): void
    {}

}
