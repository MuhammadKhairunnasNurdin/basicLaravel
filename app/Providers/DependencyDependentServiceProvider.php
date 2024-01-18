<?php

namespace App\Providers;

use App\TestDependency\Dependency;
use App\TestDependency\Dependent;
use App\TestInterface\HelloService;
use App\TestInterface\Implementor;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class DependencyDependentServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        /**
         * print this letter to check whatever our service provider is
         * called or not
         */
        //echo 'DependencyDependentServiceProvider is loaded';

        $this->app->singleton(Dependency::class, function () {
            return new Dependency();
        });

        $this->app->singleton(Dependent::class, function ($app) {
            return new Dependent($app->make(Dependency::class));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    /**
     * If your service provider registers many simple bindings, you may wish
     * to use the bindings and singletons properties instead of manually
     * registering each container binding. When the service provider is
     * loaded by the framework, it will automatically check for these
     * properties and register their bindings,
     *
     * This example $singletons property
     */
    public array $singletons = [
        HelloService::class => Implementor::class,
    ];

    /**
     * so in this method, you can return Service Provider that had to be
     * lazy loaded, so only loaded when we called those class
     *
     * but in order to refresh cache that compile our service provider by
     * laravel, we need to clear cache-compiled, you can do this by artisan
     * command: 'php artisan clear-compiled'
     *
     * and to check artisan command that can clear you can do
     * command: 'php artisan | grep clear'
     */
    public function provides(): array
    {
        return [HelloService::class, Dependency::class, Dependent::class];
    }
}
