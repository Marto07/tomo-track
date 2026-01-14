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
        DB::beginTransaction();
        try {
            $this->decreaseFromLocation($movement);
            $this->increaseToLocation($movement);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update tool stock: ' . $e->getMessage());
            throw $e;
        }
    }

    protected function decreaseFromLocation(ToolMovement $movement): void
    {
        if (!$movement->from_location_id) {
            return;
        }

        // Usamos lockForUpdate para prevenir condiciones de carrera
        $stock = StockTool::where('tool_id', $movement->tool_id)
            ->where('location_id', $movement->from_location_id)
            ->lockForUpdate()
            ->first();

        if (!$stock) {
            throw new RuntimeException('Stock record not found for source location.');
        }

        // Verificamos que haya suficiente stock antes de restar
        if ($stock->quantity < $movement->quantity) {
            throw new RuntimeException(
                'Insufficient stock in source location. Available: ' . 
                $stock->quantity . ', Requested: ' . $movement->quantity
            );
        }

        $stock->decrement('quantity', $movement->quantity);
        
        // Si después de decrementar la cantidad es 0, podrías considerar eliminar el registro
        // o mantenerlo con cantidad 0 según tus necesidades
        if ($stock->quantity <= 0) {
            // $stock->delete(); // O mantenerlo con cantidad 0
        }
    }

    protected function increaseToLocation(ToolMovement $movement): void
    {
        // Usamos updateOrCreate para manejar mejor la concurrencia
        $stock = StockTool::updateOrCreate(
            [
                'tool_id' => $movement->tool_id,
                'location_id' => $movement->to_location_id,
            ],
            [
                // Si es un registro nuevo, cantidad será 0 + movement->quantity
                // Si existe, se incrementará en el siguiente paso
                'quantity' => DB::raw('COALESCE(quantity, 0)'),
            ]
        );
        
        // Incrementamos la cantidad
        $stock->increment('quantity', $movement->quantity);
        
        // Alternativa más segura con bloqueo:
        // StockTool::where('tool_id', $movement->tool_id)
        //     ->where('location_id', $movement->to_location_id)
        //     ->lockForUpdate()
        //     ->increment('quantity', $movement->quantity);
    }
}
