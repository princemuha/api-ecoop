<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Domain\Auth\Contracts\AuthInterface;
use App\Domain\Identifier\Contracts\IdInterface;
use App\Domain\Roles\Contracts\MapRolesInterface;
use App\Domain\Logging\Contracts\LoggingInterface;
use App\Domain\Users\Contracts\UserInterface;
use App\Domain\Product\Contracts\ProductInterface;

use App\Repositories\Auth\AuthEloquent;
use App\Repositories\Identifier\IdEloquent;
use App\Repositories\Roles\MapRolesEloquent;
use App\Repositories\Logging\LoggingEloquent;
use App\Repositories\Users\UserEloquent;
use App\Repositories\Product\ProductEloquent;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthInterface::class, AuthEloquent::class);
        $this->app->bind(IdInterface::class, IdEloquent::class);
        $this->app->bind(MapRolesInterface::class, MapRolesEloquent::class);
        $this->app->bind(LoggingInterface::class, LoggingEloquent::class);
        $this->app->bind(UserInterface::class, UserEloquent::class);
        $this->app->bind(ProductInterface::class, ProductEloquent::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
