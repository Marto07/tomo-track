<?php

namespace Modules\Item\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Item\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call([]);
        Category::create([
            'name' => "Manuales"
        ]);
        Category::create([
            'name' => "Electricas"
        ]);
        Category::create([
            'name' => "Maquinaria ligera"
        ]);
        
    }
}
