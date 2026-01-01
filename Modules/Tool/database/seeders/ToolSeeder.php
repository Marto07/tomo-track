<?php

namespace Modules\Tool\Database\Seeders;


use Illuminate\Database\Seeder;
use Modules\Tool\Models\Tool;

class ToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tool::create([
            'name' => "Martillo",
            'category_id' => 1,
        ]);
        Tool::create([
            'name' => "Taladro",
            'category_id' => 2,
        ]);
        Tool::create([
            'name' => "Compresor de asfalto",
            'category_id' => 3,
        ]);
    }
}
