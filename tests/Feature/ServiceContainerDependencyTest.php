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
        $this->app->bind(BindTest::class, function ($app) {
            return new BindTest('anas', 'nurdin');
        });

        $bindTest1 = $this->app->make(BindTest::class);
        $bindTest2 = $this->app->make(BindTest::class);

        self::assertEquals('anas', $bindTest1->firstName);
        self::assertEquals('nurdin', $bindTest2->lastName);

        /*this indicate that object isn't same, although firstName and lastName value is same*/
        self::assertNotSame($bindTest1, $bindTest2);
    }
}
