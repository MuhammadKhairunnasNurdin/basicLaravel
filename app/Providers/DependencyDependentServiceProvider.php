<?php

namespace App\Providers;

use App\TestDependency\Dependency;
use App\TestDependency\Dependent;
use App\TestInterface\HelloService;
use App\TestInterface\Implementor;
use Illuminate\Support\ServiceProvider;

class DependencyDependentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
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
}
