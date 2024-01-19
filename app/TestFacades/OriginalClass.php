<?php

namespace App\TestFacades;

class OriginalClass
{
    public function hey(): string
    {
        return 'hey bro';
    }

    public function bro(): array
    {
        return ['hey', 'anas'];
    }

    public function paramTest(string $arg): string
    {
        return "param: $arg";
    }
}
