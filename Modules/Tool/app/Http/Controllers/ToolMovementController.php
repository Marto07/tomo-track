<?php

namespace Modules\Tool\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Tool\Models\ToolMovement;
use Modules\Tool\Models\Tool;
use Modules\Location\Models\Location;
use Modules\Core\Traits\ApiResponse;
use Modules\Tool\Events\ToolMoved;
use Modules\Tool\Services\ToolMovementService;
use Modules\Tool\Services\ToolService;
use Illuminate\Support\Facades\Log;
use Modules\Tool\Actions\AddStockToolAction;
use Modules\Tool\Actions\TransferToolAction;
use Modules\Tool\Classes\DTO\TransferToolData;
use Modules\Tool\Exceptions\NotEnoughStock;
use Modules\Tool\Http\Requests\AddStockToolRequest;
use Modules\Tool\Http\Requests\TransferToolRequest;

class ToolMovementController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->successResponse(ToolMovement::with(['tool', 'fromLocation', 'toLocation', 'movementType'])->get());
    }



    /**
     * Store a newly created resource in storage.
     */
    public function addStock(AddStockToolRequest $request, AddStockToolAction $action) {
        //validate request
        $validated = $request->validated();

        try {

            $movement = $action(
                $validated['tool_id'],
                $validated['to_location_id'],
                $validated['quantity']
            );

        } catch (\Throwable $th) {
            Log::error("Error adding stock: " . $th->getMessage());
            return $this->errorResponse("Error in adding stock.", 500);
        }

        $movement->load(['tool', 'fromLocation', 'toLocation', 'movementType']);

        return $this->successResponse($movement, 201);
    }



    // Transfer tool from point A to point B
    public function transfer(TransferToolRequest $request, TransferToolAction $action) {

        $validated = $request->validated();    

        $data = new TransferToolData(
            $validated['tool_id'],
            $validated['from_location_id'],
            $validated['to_location_id'],
            $validated['quantity']
        );

        try {
            $result = $action($data);
        } catch (NotEnoughStock $e) {

            Log::error($e->getMessage());
            return $this->errorResponse("Not enough stock.", 400);

        } catch (\Throwable $th) {

            Log::error("Error transferring tool: " . $th->getMessage());
            return $this->errorResponse("Error in transferring tool.", 500);

        }

        $movement = $result->load(['tool', 'fromLocation', 'toLocation', 'movementType']);
        
        return $this->successResponse($movement, 201);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('tool::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('tool::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
