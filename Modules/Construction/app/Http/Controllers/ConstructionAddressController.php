<?php

namespace Modules\Construction\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Core\Traits\ApiResponse;
use Modules\Construction\Models\Construction;

class ConstructionAddressController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $construction)
    {
        $construction = Construction::with('addresses')->find($construction);
        if (!$construction) {
            return $this->errorResponse('Construction not found', 404);
        }

        return $this->successResponse($construction->addresses);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $construction) {
        $construction = Construction::find($construction);
        if (!$construction) {
            return $this->ErrorResponse('Construcción no encontrada');
        }

        $validated = $request->validate([
            'street' => 'required|string|max:255',
            'number' => 'nullable|string|max:50',
            'apartment' => 'nullable|string|max:50',
            'city_id' => 'required|exists:cities,id',
            'is_principal' => 'sometimes|boolean',
        ]);

        $address = $construction->addresses()->create($validated);

        if (!$address) {
            return $this->ErrorResponse('Error al agregar la dirección');
        }

        return $this->SuccessResponse($address, 'Dirección agregada correctamente');
    }

    /**
     * Show the specified resource.
     */
    public function show($construction, $address)
    {
        $construction = Construction::find($construction);
        if (!$construction) {
            return $this->errorResponse('Construction not found', 404);
        }

        $address = $construction->addresses()->find($address);
        if (!$address) {
            return $this->errorResponse('Address not found for this construction', 404);
        }

        return $this->successResponse($address);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $construction, $address) {
        $construction = Construction::find($construction);
        if (!$construction) {
            return $this->ErrorResponse('Construcción no encontrada');
        }

        $address = $construction->addresses()->find($address);
        if (!$address) {
            return $this->errorResponse('Address not found for this construction', 404);
        }

        $validated = $request->validate([
            'street' => 'sometimes|string|max:255',
            'number' => 'nullable|string|max:50',
            'apartment' => 'nullable|string|max:50',
            'city_id' => 'sometimes|exists:cities,id',
            'is_principal' => 'sometimes|boolean',
        ]);

        $address->update($validated);

        return $this->SuccessResponse($address, 'Dirección actualizada correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($construction, $address) {
        $construction = Construction::find($construction);
        if (!$construction) {
            return $this->ErrorResponse('Construcción no encontrada');
        }

        $address = $construction->addresses()->find($address);
        if (!$address) {
            return $this->errorResponse('Address not found for this construction', 404);
        }

        $address->delete();

        return $this->SuccessResponse(null, 'Dirección eliminada correctamente');
    }
}
