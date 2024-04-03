<?php

namespace Database\Seeders;

use App\Models\IdeHelperTest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IdeHelperTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        IdeHelperTest::factory(10)->create();
    }
}
