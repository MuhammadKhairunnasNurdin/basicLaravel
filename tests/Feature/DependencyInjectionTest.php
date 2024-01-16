<?php

namespace Tests\Feature;

use App\TestDependency\Dependency;
use App\TestDependency\Dependent;
use Tests\TestCase;

class DependencyInjectionTest extends TestCase
{
    public function testDependencyInjection()
    {
        $dependency = new Dependency();
        $dependent = new Dependent($dependency);

        self::assertEquals('from dependency and dependent', $dependent->getDependencyFunction());
    }
}
