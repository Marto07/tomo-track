<?php

namespace Modules\Tool\Tests\Unit;

use Illuminate\Http\Request;
use Modules\Location\Models\Location;
use Modules\Tool\Models\Tool;
use Modules\Tool\Services\ToolService;
use Tests\TestCase;

class TransferToolTest extends TestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;
    /**
     * A basic test example.
     */
    /* public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    } */

    /* public function test_transfer_moves_stock_between_locations()
    {
        $service = new ToolService();

        $locationA = Location::factory()->create();
        $locationB = Location::factory()->create();
        $category = \Modules\Tool\Models\Category::create([
            'name' => 'Category 1',
        ]);
        $tool1 = Tool::factory()->create(['category_id' => $category->id]); 
        if($service->addStock($tool1->id, $locationA->id, 10)) {
            $this->assertTrue(true, "todo correcto ejn el stock inicial");
            dump("Stock inicial agregado correctamente");
        }

        $this->assertDatabaseHas('tool_movements', [
            'tool_id' => $tool1->id,
            'to_location_id' => $locationA->id,
            'quantity' => 10
        ]);
        dump("movimiento creado en database correctamente");
        dump("hay stock?: " . $service->hasStock($tool1->id, $locationA->id, 10));

        if($result = $service->transferTool($tool1->id, $locationA->id, $locationB->id, 3)) {
            $this->assertTrue(true, "Tool transferred successfully");
        }
        $stockFrom = \Modules\Tool\Models\StockTool::where('tool_id', $tool1->id)
            ->where('location_id', $locationA->id)->first();
        $stockTo = \Modules\Tool\Models\StockTool::where('tool_id', $tool1->id)
            ->where('location_id', $locationB->id)->first();
        dump("Stock desde: {$stockFrom->quantity}");
        dump("Stock hasta: {$stockTo->quantity}");


        // $this->assertDatabaseHas('tool_movements', [
        //     'tool_id' => $tool1->id,
        //     'to_location_id' => $locationB->id,
        //     'quantity' => 3
        // ]); 
        // dump("movimiento de transferencia registrado correctamente");

        
    }

    public function test_post_transfer_endpoint()
    {

        $locationA = Location::factory()->create();
        $locationB = Location::factory()->create();
        $category = \Modules\Tool\Models\Category::create([
            'name' => 'Category 1',
        ]);
        $tool1 = Tool::factory()->create(['category_id' => $category->id]); 

        $response = $this->postJson('/api/tools-movements', [
            'tool_id' => $tool1->id,
            'to_location_id' => $locationB->id,
            'quantity' => 5,
        ]);

        $this->assertDatabaseHas('stock_tools', [
            'tool_id' => $tool1->id,
            'location_id' => $locationB->id,
            'quantity' => 5
        ]);
    } */
}
