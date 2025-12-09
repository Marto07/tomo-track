<?php

namespace Modules\Item\Database\Seeders;


use Illuminate\Database\Seeder;
use Modules\Item\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::create([
            'name' => "Martillo",
            'category_id' => 1,
        ]);
        Item::create([
            'name' => "Taladro",
            'category_id' => 2,
        ]);
        Item::create([
            'name' => "Compresor de asfalto",
            'category_id' => 3,
        ]);
    }
}
