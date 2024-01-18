<?php

namespace App\TestInterface;

class Implementor implements HelloService
{
    public function hello(string $message): string
    {
        return "hey $message";
    }
}
