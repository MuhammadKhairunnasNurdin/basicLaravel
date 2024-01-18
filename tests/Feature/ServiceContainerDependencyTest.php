<?php

namespace Tests\Feature;

use App\TestDependency\BindTest;
use App\TestDependency\Dependency;
use App\TestDependency\Dependent;
use Tests\TestCase;

class ServiceContainerDependencyTest extends TestCase
{
    public function testServiceContainer()
    {
        $dependency = $this->app->make(Dependency::class);
        $dependent = new Dependent($dependency);

        self::assertEquals('from dependency and dependent', $dependent->getDependencyFunction());
        self::assertEquals('from dependency', $dependency->test());
    }

    public function testBind()
    {
        $this->app->bind(BindTest::class, function () {
            return new BindTest('anas', 'nurdin');
        });

        $bindTest1 = $this->app->make(BindTest::class);
        $bindTest2 = $this->app->make(BindTest::class);

        self::assertEquals('anas', $bindTest1->firstName);
        self::assertEquals('nurdin', $bindTest2->lastName);

        /**
         * this indicate that instance isn't same, although firstName and
         * lastName value is same
         */
        self::assertNotSame($bindTest1, $bindTest2);
    }

    public function testSingleton()
    {
        $this->app->singleton(BindTest::class, function () {
            return new BindTest('john', 'doe');
        });

        $bindTest1 = $this->app->make(BindTest::class);
        $bindTest2 = $this->app->make(BindTest::class);

        self::assertEquals('john', $bindTest1->firstName);
        self::assertEquals('doe', $bindTest2->lastName);

        /**
         * this indicate that instance is same, although we called make()
         * function 2 times
         */
        self::assertSame($bindTest1, $bindTest2);
    }

    public function testInstance()
    {
        $bindTest = new BindTest('parjo', 'eling');
        $this->app->instance(BindTest::class, $bindTest);

        $bindTest1 = $this->app->make(BindTest::class);
        $bindTest2 = $this->app->make(BindTest::class);

        /**
         * this indicate that instance is same that we passed in
         * instance(key, object), although we called make(key) function
         * second times and same too with first instance we make in
         * bindTest variable
         */
        self::assertSame($bindTest, $bindTest1);
        self::assertSame($bindTest, $bindTest2);
        self::assertSame($bindTest1, $bindTest2);
    }

    public function testAutomaticServiceContainer()
    {
        $this->app->singleton(Dependency::class, function () {
            return new Dependency();
        });

        $dependency = $this->app->make(Dependency::class);
        $dependent = $this->app->make(Dependent::class);

        /**
         * so with automation from ServiceContainer we haven't injected
         * dependency instance when we create dependent instance like in
         * testServiceContainer() function, instead we can use singleton()
         * function or instance() function or bind() function to serve
         * dependency injection automatically way
         */
        self::assertSame($dependency, $dependent->dependency);
    }

    public function testDependencyInjectionInClosure()
    {
        $this->app->singleton(Dependency::class, function () {
            return new Dependency();
        });

        $dependent1 = $this->app->make(Dependent::class);
        $dependent2 = $this->app->make(Dependent::class);

        /**
         * this example that our dependent object haven't same instance
         */
        self::assertNotSame($dependent1, $dependent2);

        /**
         * so in order to make dependent instance also use singleton()
         * method, we can use singleton() but with closure accept $app
         * instance from Application in Illuminate/Foundation/Application
         * class as a parameter.
         *
         * In terms of when to use one over the other, it depends on your
         * specific needs:
         *
         * If you’re building a Laravel application, you’ll mostly be
         * interacting with the Illuminate\Foundation\Application class,
         * as it provides the concrete implementation of the Laravel
         * application.
         *
         * If you’re building a package that needs to interact with
         * Laravel, but you want to keep your package decoupled from
         * Laravel’s concrete implementations, you might choose to t
         * ype-hint against the
         * Illuminate\Contracts\Foundation\Application interface instead.
         * This allows your package to remain flexible and potentially
         * compatible with other PHP frameworks.
         */
        $this->app->singleton(Dependent::class, function ($app) {
            return new Dependent($app->make(Dependency::class));
        });

        $dependent3 = $this->app->make(Dependent::class);
        $dependent4 = $this->app->make(Dependent::class);

        self::assertSame($dependent3, $dependent4);
    }
}
