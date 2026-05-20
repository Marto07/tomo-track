<?php

namespace Modules\Tool\Services;

use Illuminate\Support\Facades\DB;
use Modules\Tool\Models\StockTool;
use Modules\Tool\Models\ToolMovement;

class ToolMovementService
{
    public function __construct(
        protected ToolService $toolService
    ) {}

    public function addStock(int $toolId, int $locationId, int $quantity = 0) : ToolMovement
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

    public function moveStock(int $toolId, int $fromLocationId, int $toLocationId, int $quantity) : ToolMovement
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

    public function transferTool(int $toolId, int $fromLocationId, int $toLocationId, int $quantity) : ToolMovement
    {
        
        $this->toolService->validateStock($toolId, $fromLocationId, $quantity);
            
        $movement = $this->moveStock($toolId, $fromLocationId, $toLocationId, $quantity);
    
        return $movement;

    }
}
