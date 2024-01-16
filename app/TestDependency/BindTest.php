<?php

namespace App\TestDependency;

class BindTest
{
    public function __construct(
        public string $firstName,
        public string $lastName,
    ) {

    }
}
