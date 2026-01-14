<?php

namespace Modules\Tool\Services;

use Modules\Tool\Models\StockTool;

class ToolMovementService
{
    public function handle() {}

    public function validateStock($toolId, $fromLocationId, $quantity)
    {
        // Logic to validate if there is enough stock of the tool at the given location
        $stock = StockTool::where('tool_id', $toolId)
            ->where('location_id', $fromLocationId)
            ->value('quantity');

        return $stock !== null && $stock >= $quantity;
    }
}
