<?php

namespace Modules\Tool\Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Location\Models\Location;
use Modules\Tool\Database\Seeders\MovementTypeSeeder;
use Modules\Tool\Models\Category;
use Modules\Tool\Models\StockTool;
use Modules\Tool\Models\Tool;
use Tests\TestCase;

class TransferStockToolTest extends TestCase
{
    use RefreshDatabase;

    public function test_transfer_fails_when_stock_is_insufficient(): void
    {
        /** @var User $user */  
        $user = User::factory()->create();

        $category = Category::factory()->create();

        $tool = Tool::factory()->create(['category_id' => $category->id]);

        $fromLocation = Location::factory()->create();

        $toLocation = Location::factory()->create();

        $stockTool = StockTool::factory()->create([
            'tool_id' => $tool->id,
            'location_id' => $fromLocation->id,
            'quantity' => 4
        ]);

        $payload = [
            'tool_id' => $tool->id,
            'quantity' => 10,
            'from_location_id' => $fromLocation->id,
            'to_location_id' => $toLocation->id,
        ];

        $response = $this->actingAs($user)
            ->postJson('/api/v1/tools/transfer', $payload);

        $response->assertStatus(400);
    }

    public function test_transfer_success_when_has_enough_stock(): void
    {

        $this->seed(MovementTypeSeeder::class);

        /** @var User $user */  
        $user = User::factory()->create();

        $category = Category::factory()->create();

        $tool = Tool::factory()->create(['category_id' => $category->id]);

        $fromLocation = Location::factory()->create();

        $toLocation = Location::factory()->create();


        $stockTool = StockTool::factory()->create([
            'tool_id' => $tool->id,
            'location_id' => $fromLocation->id,
            'quantity' => 4
        ]);

        $payload = [
            'tool_id' => $tool->id,
            'quantity' => 4,
            'from_location_id' => $fromLocation->id,
            'to_location_id' => $toLocation->id,
        ];

        $response = $this->actingAs($user)
            ->postJson('/api/v1/tools/transfer', $payload);

        $response->assertStatus(201);

        $this->assertDatabaseHas('stock_tools', [
            'tool_id' => $tool->id,
            'location_id' => $toLocation->id ,
            'quantity' => $payload['quantity']
        ]);
    }
}
