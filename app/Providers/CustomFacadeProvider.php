<?php

namespace App\Providers;

use App\TestFacades\OriginalClass;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class CustomFacadeProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        /**
         * if you want to make instance from OriginalClass always
         * different, try with bind() method
         */
        $this->app->singleton('originalClass', function () {
            return new OriginalClass();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    public function provides(): array
    {
        return ['originalClass'];
    }
}
