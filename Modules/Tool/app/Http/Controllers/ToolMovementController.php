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
    public function store(Request $request) {
        $validatedData = $request->validate([
            'tool_id' => 'required|exists:tools,id',
            'from_location_id' => 'nullable|exists:locations,id',
            'to_location_id' => 'required|exists:locations,id',
            'quantity' => 'required|integer|min:1',
            'movement_type_id' => 'required|exists:movement_types,id',
        ]);

        if (isset($validatedData['from_location_id'])) {
            $toolMovementService = new ToolMovementService();
            $isValidStock = $toolMovementService->validateStock(
                $validatedData['tool_id'],
                $validatedData['from_location_id'],
                $validatedData['quantity']
            );
            if (!$isValidStock) {
                return $this->errorResponse('Insufficient stock at the from location.', 400);
            }
        }

        $movement = ToolMovement::create([
            'tool_id' => $validatedData['tool_id'],
            'from_location_id' => $validatedData['from_location_id'] ?? null,
            'to_location_id' => $validatedData['to_location_id'],
            'quantity' => $validatedData['quantity'],
            'movement_type_id' => $validatedData['movement_type_id'],
            'moved_at' => now(),
        ]);

        event(new ToolMoved($movement));
        $movement->load(['tool', 'fromLocation', 'toLocation', 'movementType']);

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
