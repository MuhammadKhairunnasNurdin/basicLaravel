<?php

namespace App\TestDependency;

class Dependent
{
    public Dependency $dependency;

    public function __construct(Dependency $dependency)
    {
        $this->dependency = $dependency;
    }

    public function getDependencyFunction(): string
    {
        return $this->dependency->test().' and dependent';
    }
}
