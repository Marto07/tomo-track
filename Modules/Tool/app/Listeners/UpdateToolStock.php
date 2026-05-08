<?php

namespace Modules\Tool\Listeners;

use Modules\Tool\Events\ToolMoved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Modules\Tool\Models\ToolMovement;
use Modules\Tool\Models\StockTool;
use RuntimeException;
use Illuminate\Support\Facades\Log;

class UpdateToolStock
{
    /**
     * Handle the event.
     */
    public function handle(ToolMoved $event): void {
       $movement = $event->movement;

        // CASO 1: Ingreso de stock (from_location es nulo)
        if (is_null($movement->from_location_id) && !is_null($movement->to_location_id)) {
            
            // Buscamos o creamos el registro de stock en la ubicación de destino
            $stock = StockTool::firstOrCreate(
                [
                    'tool_id'     => $movement->tool_id,
                    'location_id' => $movement->to_location_id,
                ],
                [
                    'quantity'    => 0, // Valor inicial si se crea
                    'status'      => 'available', // O el estado por defecto
                ]
            );

            // Incrementamos la cantidad
            $stock->increment('quantity', $movement->quantity);
        }
        
        if ($movement->from_location_id && $movement->to_location_id) {
            // Transferencia entre ubicaciones
            $stockFrom = StockTool::where('tool_id', $movement->tool_id)
                ->where('location_id', $movement->from_location_id)
                ->first();

            // Decrementamos el stock de la ubicación de origen
            $stockFrom->decrement('quantity', $movement->quantity);

            // Buscamos o creamos el registro de stock en la ubicación de destino
            $stockTo = StockTool::firstOrCreate(
                [
                    'tool_id'     => $movement->tool_id,
                    'location_id' => $movement->to_location_id,
                ],
                [
                    'quantity'    => 0, // Valor inicial si se crea
                    'status'      => 'available', // O el estado por defecto
                ]
            );

            // Incrementamos la cantidad en la ubicación de destino
            $stockTo->increment('quantity', $movement->quantity);
        }
    }

   

    
}
