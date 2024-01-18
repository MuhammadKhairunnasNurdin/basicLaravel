<?php

namespace App\TestInterface;

interface HelloService
{
    public function hello(string $message): string;
}
