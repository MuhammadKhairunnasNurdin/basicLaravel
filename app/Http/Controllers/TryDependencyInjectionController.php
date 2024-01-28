<?php

namespace App\Http\Controllers;

use App\TestDependency\Dependency;

class TryDependencyInjectionController extends Controller
{
    public function __construct(
        public Dependency $dependency
    ) {
    }

    public function dependencyInjection(): string
    {
        return $this->dependency->test();
    }
}
