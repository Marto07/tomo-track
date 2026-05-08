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
    public function store(StoreLocation $request) {
        $validated = $request->validated();
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
        $validated = $request->validated();

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
