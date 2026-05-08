<?php

namespace Modules\Tool\Services;

use Modules\Tool\Models\StockTool;
use Illuminate\Support\Facades\DB;
use Modules\Tool\Models\ToolMovement;
use Modules\Tool\Exceptions\NotEnoughStock;

class ToolService
{
    public function handle() {}

    public function hasStock($toolId, $locationId, $quantity)
    {
        $stock = StockTool::where('tool_id', $toolId)
            ->where('location_id', $locationId)
            ->value('quantity');

        return $stock !== null && $stock >= $quantity;
    }

    public function validateStock($toolId, $fromLocationId, $quantity)
    {
        if (!$this->hasStock($toolId, $fromLocationId, $quantity)) {
            throw new NotEnoughStock("Not enough stock");
        }
    }


    public function transferTool($toolId, $fromLocationId, $toLocationId, $quantity)
    {
        $result = DB::transaction(function () use ($toolId, $fromLocationId, $toLocationId, $quantity) {
                $this->validateStock($toolId, $fromLocationId, $quantity);
                    
                $movement = $this->moveStock($toolId, $fromLocationId, $toLocationId, $quantity);
           
                return $movement;
        });
        return $result;
    }

    public function addStock($toolId, $locationId, $quantity = 0)
    {
        return ToolMovement::create(
            [ 
                'tool_id' => $toolId,
                'to_location_id' => $locationId,
                'quantity' => $quantity,
                'movement_type_id' => 1, // ID para "Ingreso"
                'moved_at' => now(),
            ]
        );
    }

    public function moveStock($toolId, $fromLocationId, $toLocationId, $quantity)
    {
        return ToolMovement::create(
            [ 
                'tool_id' => $toolId,
                'from_location_id' => $fromLocationId,
                'to_location_id' => $toLocationId,
                'quantity' => $quantity,
                'movement_type_id' => 2, // ID para "Transferencia"
                'moved_at' => now(),
            ]
        );
    }

    public function increaseStock($toolId, $locationId, $quantity)
    {
        $stock = StockTool::where('tool_id', $toolId)
        ->where('location_id', $locationId)->firstOrFail();

        $stock->quantity += $quantity;
        $stock->save();
    }

    public function decreaseStock($toolId, $locationId, $quantity)
    {
       $stock = StockTool::where('tool_id', $toolId)
            ->where('location_id', $locationId)->firstOrFail();

        $stock->quantity -= $quantity;
        $stock->save();
    }

}
