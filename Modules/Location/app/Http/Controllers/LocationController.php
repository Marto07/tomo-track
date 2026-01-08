<?php

namespace Modules\Location\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Location\Models\Location;
use Modules\Location\Http\Requests\StoreLocation;
use Modules\Location\Http\Requests\UpdateLocation;
use Illuminate\Http\JsonResponse;
use Modules\Core\Traits\ApiResponse;

class LocationController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Location::query();
        
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $locations = $query->paginate($request->per_page ?? 10);
        
        return $this->PaginatedResponse($locations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:300',
            'street' => 'required|string|max:150',
            'apartment' => 'nullable|string|max:50',
            'number' => 'nullable|integer',
            'city_id' => 'required|exists:cities,id',
            'location_type_id' => 'required|exists:location_types,id'
        ]);

        $location = Location::create($validated);

        if (!$location) {
            return $this->ErrorResponse('Error al crear el registro');
        }

        return $this->SuccessResponse($location);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $location = Location::find($id);

        if (!$location) {
            return $this->ErrorResponse('Registro no encontrado');
        }

        return $this->SuccessResponse($location);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocation $request, $id) {
        $validated = $request->validated([
            'name' => 'sometimes|required|string|max:100',
            'description' => 'sometimes|nullable|string|max:300',
            'location_type_id' => 'sometimes|required|exists:location_types,id',
            'street' => 'sometimes|required|string|max:150',
            'apartment' => 'sometimes|nullable|string|max:50',
            'number' => 'sometimes|nullable|integer',
            'city_id' => 'sometimes|required|exists:cities,id',
        ]);

        $location = Location::find($id);

        if (!$location) {
            return $this->ErrorResponse('Registro no encontrado');
        }

        $location->update($validated);

        return $this->SuccessResponse($location);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $location = Location::find($id);

        if (!$location) {
            return $this->ErrorResponse('Registro no encontrado');
        }

        $location->delete();

        return $this->SuccessResponse($location);
    }
}
