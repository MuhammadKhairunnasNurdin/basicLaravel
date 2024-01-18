<?php

namespace Tests\Feature;

use App\TestDependency\Dependency;
use App\TestDependency\Dependent;
use App\TestInterface\HelloService;
use Tests\TestCase;

class ServiceProviderTest extends TestCase
{
    public function testServiceProvider()
    {
        $dependency = $this->app->make(Dependency::class);
        $dependency2 = $this->app->make(Dependency::class);
        $dependent = $this->app->make(Dependent::class);
        $dependent2 = $this->app->make(Dependent::class);

        self::assertSame($dependency, $dependency2);
        self::assertSame($dependent, $dependent2);
        self::assertSame($dependency, $dependent2->dependency);
        self::assertSame($dependency2, $dependent->dependency);
    }

    public function testInterfaceBindingServiceProvider()
    {
        $interface = $this->app->make(HelloService::class);
        $interface2 = $this->app->make(HelloService::class);

        self::assertSame($interface, $interface2);
        self::assertEquals('hey anas', $interface->hello('anas'));
    }

    /**
     * run this to check our service load or not, but if you do this always
     * call our service provider, because when unit test mode, all service
     * provider will be loaded, you can test by echo in and load your
     * application with 'php artisan serve'
     */
    public function testEmpty()
    {
        self::assertTrue(true);
    }
}
