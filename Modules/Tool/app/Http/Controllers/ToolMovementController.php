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
use Modules\Tool\Exceptions\NotEnoughStock;

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
    public function addStock(Request $request) {
        //validate request
        $validated = $request->validate([
            'tool_id' => 'required|exists:tools,id',
            'to_location_id' => 'required|exists:locations,id',
            'quantity' => 'required|integer|min:1',
            // 'movement_type_id' => 'required|exists:movement_types,id',
        ]);

        //if validation success, we initialize the service
        $toolService = new ToolService();

        try {
            $movement = $toolService->addStock(
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
    public function transfer(Request $request) {
        //validate request
        $validated = $request->validate([
            'tool_id' => 'required|exists:tools,id',
            'from_location_id' => 'required|exists:locations,id',
            'to_location_id' => 'required|exists:locations,id|different:from_location_id',
            'quantity' => 'required|integer|min:1',
        ]);

        //if validation success, we initialize the service
        $toolService = new ToolService();


        try {
            $result = $toolService->transferTool(
                $validated['tool_id'],
                $validated['from_location_id'],
                $validated['to_location_id'],
                $validated['quantity']
            );
        } catch (NotEnoughStock $e) {
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
