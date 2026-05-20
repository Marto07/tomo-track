<?php

namespace Modules\Tool\Services;

use Modules\Tool\Models\StockTool;
use Modules\Tool\Models\ToolMovement;

class StockToolService
{
    public function handle() {}

    public function addStock(ToolMovement $toolMovement) : StockTool 
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

    public function getStockFrom(int $toolId, int $fromLocationId) : StockTool
    {
        return StockTool::where('tool_id', $toolId)
            ->where('location_id', $fromLocationId)
            ->first();
    }

    public function getOrCreateStockTo(int $toolId, int $toLocationId) : StockTool
    {
        return StockTool::firstOrCreate(
            [
                'tool_id'     => $toolId,
                'location_id' => $toLocationId,
            ],
            [
                'quantity'    => 0, // Valor inicial si se crea
                'status'      => 'available', // el estado por defecto
            ]
        );
    }

    public function transferStock() {}
}
