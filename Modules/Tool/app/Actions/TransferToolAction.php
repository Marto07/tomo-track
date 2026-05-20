<?php

namespace Modules\Tool\Actions;

use Illuminate\Support\Facades\DB;
use Modules\Tool\Classes\DTO\TransferToolData;
use Modules\Tool\Models\StockTool;
use Modules\Tool\Models\ToolMovement;
use Modules\Tool\Services\StockToolService;
use Modules\Tool\Services\ToolMovementService;

class TransferToolAction
{
    public function __construct(
        protected StockToolService $stockToolService,
        protected ToolMovementService $toolMovementService
    ) {}

    public function __invoke(TransferToolData $data) : ToolMovement
    {
        return DB::transaction(function () use ($data) {

            $result = $this->toolMovementService->transferTool(
                $data->tool_id,
                $data->from_location_id,
                $data->to_location_id,
                $data->quantity
            );
            // Transferencia entre ubicaciones
            $stockFrom = $this->stockToolService->getStockFrom(
                $data->tool_id, 
                $data->from_location_id
            );

            // Decrementamos el stock de la ubicación de origen
            $stockFrom->decrement('quantity', $data->quantity);

            // Buscamos o creamos el registro de stock en la ubicación de destino
            $stockTo = $this->stockToolService->getOrCreateStockTo(
                $data->tool_id, 
                $data->to_location_id
            );

            // Incrementamos la cantidad en la ubicación de destino
            $stockTo->increment('quantity', $data->quantity);

            return $result;

        });
        
    }
}
