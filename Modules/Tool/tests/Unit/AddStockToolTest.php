<?php

namespace Modules\Tool\Tests\Unit;

use App\Models\User;
use Modules\Location\Models\Location;
use Modules\Tool\Models\StockTool;
use Modules\Tool\Models\Tool;
use Tests\TestCase;

class AddStockToolTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }
/* 

    public function test_user_can_transfer_tools_successfully(): void
    {
        $user = User::factory()->create();

        $tool = Tool::factory()->create([
            'stock' => 10,
        ]);

        $payload = [
            'tool_id' => $tool->id,
            'quantity' => 5,
        ];

        $response = $this->actingAs($user)
            ->postJson('/api/tools/transfer', $payload);

        $response->assertStatus(201);

        $this->assertDatabaseHas('tools', [
            'id' => $tool->id,
            'stock' => 5,
        ]);
    }

    public function test_transfer_fails_when_stock_is_insufficient(): void
    {
        $user = User::factory()->create();

        $tool = Tool::factory()->create();

        $location1 = Location::factory()->create();

        $location2 = Location::factory()->create();

        $stockTool = StockTool::factory()->create([
            'tool_id' => $tool->id,
            'location_id' => $location1->id,
            'quantity' => 4
        ]);

        $payload = [
            'tool_id' => $tool->id,
            'quantity' => 10,
            'from_location' => $location1->id,
            'to_location' => $location2->id,
        ];

        $response = $this->actingAs($user)
            ->postJson('/api/v1/tools/transfer', $payload);

        $response->assertStatus(400);
    } */
}
