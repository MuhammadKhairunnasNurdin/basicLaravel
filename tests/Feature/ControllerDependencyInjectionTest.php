<?php

namespace Tests\Feature;

use Tests\TestCase;

class ControllerDependencyInjectionTest extends TestCase
{
    public function testDependencyInjection()
    {
        $this->get('/dependencyController')
            ->assertContent('from dependency');
    }

    public function testDependentDependency()
    {
        $this->get('/dependentController/one')
            ->assertContent('from dependency and dependent: one');
    }

}
