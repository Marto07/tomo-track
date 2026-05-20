<?php

namespace Modules\Tool\Actions;

use Illuminate\Support\Facades\DB;
use Modules\Tool\Models\StockTool;
use Modules\Tool\Models\ToolMovement;
use Modules\Tool\Services\ToolMovementService;

class AddStockToolAction
{
    public function __construct(
        protected ToolMovementService $toolMovementService
    ) {}

    public function __invoke(int $toolId, int $locationId, int $quantity = 0) : ToolMovement
    {
        return DB::transaction(function () use ($toolId, $locationId,$quantity) {

            $toolMovement = $this->toolMovementService->addStock($toolId, $locationId, $quantity);

            $this->addPhysicalStock($toolMovement);

            return $toolMovement;

        });
    }

    private function addPhysicalStock(ToolMovement $toolMovement) : StockTool
    {
        $stock = StockTool::firstOrCreate(
                [
                    'tool_id'     => $toolMovement->tool_id,
                    'location_id' => $toolMovement->to_location_id,
                ],
                [
                    'quantity'    => 0, 
                    'status'      => 'available', //create the tock available by default
                ]
            );

        $stock->increment('quantity', $toolMovement->quantity);

        return $stock->refresh();
    }
}
