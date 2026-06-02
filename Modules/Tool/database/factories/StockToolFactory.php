<?php

namespace Modules\Tool\Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Location\Models\Location;
use Modules\Tool\Enums\ToolStatus;
use Modules\Tool\Models\Tool;

class StockToolFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Tool\Models\StockTool::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'tool_id' => Tool::factory(),
            'location_id' => Location::factory(),
            'serial_number' => fake()->countryCode(),
            'status' => ToolStatus::AVAILABLE,
            'quantity' => fake()->numberBetween(1,20),
            'created_by' => User::factory(),
        ];
    }
}

