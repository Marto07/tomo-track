<?php

namespace Modules\Tool\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Tool\Models\MovementType;
use Modules\Core\Traits\ApiResponse;
use Modules\Tool\Http\Requests\StoreMovementTypeRequest;
use Modules\Tool\Http\Requests\UpdateMovementTypeRequest;

class MovementTypeController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return $this->SuccessResponse(MovementType::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovementTypeRequest $request) {
        $validated = $request->validated();

        $movementType = MovementType::create($validated);
        if (!$movementType) {
            return $this->ErrorResponse('Failed to create Movement Type', 500);
        }
        return $this->SuccessResponse($movementType, 201);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $movementType = MovementType::find($id);
        if (!$movementType) {
            return $this->ErrorResponse('Movement Type not found', 404);
        }
        return $this->SuccessResponse($movementType);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovementTypeRequest $request, $id) {
        $validated = $request->validated();

        $movementType = MovementType::find($id);
        if (!$movementType) {
            return $this->ErrorResponse('Movement Type not found', 404);
        }

        $movementType->update($validated);

        return $this->SuccessResponse($movementType);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $movementType = MovementType::find($id);
        if (!$movementType) {
            return $this->ErrorResponse('Movement Type not found', 404);
        }

        $movementType->delete();

        return $this->SuccessResponse(null, 204);
    }
}
