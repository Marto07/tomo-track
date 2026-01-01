<?php

namespace Modules\Tool\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Tool\Database\Seeders\CategoriesSeeder;
use Modules\Tool\Database\Seeders\ToolSeeder;

class ToolDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            CategoriesSeeder::class,
            ToolSeeder::class,
        ]);
    }
}
