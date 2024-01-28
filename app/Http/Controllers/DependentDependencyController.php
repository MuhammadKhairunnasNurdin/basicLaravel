<?php

namespace App\Http\Controllers;

use App\TestDependency\Dependent;

class DependentDependencyController extends Controller
{
    public function __construct(
        public Dependent $dependent
    ) {
    }

    public function getDependentFunc(string $whatever): string
    {
        return $this->dependent->tryDependentDependency($whatever);
    }
}
