<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Infrastructure\Auth\Contracts\AuthInterface;
use App\Infrastructure\Auth\Repositories\AuthEloquent;
use App\Infrastructure\Identifier\Contracts\IdentifierInterface;
use App\Infrastructure\Identifier\Repositories\IdentifierEloquent;
use App\Infrastructure\Marketplace\Banner\Contracts\BannerInterface;
use App\Infrastructure\Marketplace\Banner\Repositories\BannerEloquent;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthInterface::class, AuthEloquent::class);
        $this->app->bind(IdentifierInterface::class, IdentifierEloquent::class);
        $this->app->bind(BannerInterface::class, BannerEloquent::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
