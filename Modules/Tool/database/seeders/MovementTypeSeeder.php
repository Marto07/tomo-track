<?php

namespace Modules\Tool\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Tool\Models\MovementType;

class MovementTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movementTypes = [
            ['name' => 'Ingreso'],
            ['name' => 'Transferencia'],
            ['name' => 'Salida'],
        ];

        foreach ($movementTypes as $type) {
            MovementType::create($type);
        }
    }
}
