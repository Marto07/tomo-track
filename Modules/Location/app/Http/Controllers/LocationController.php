<?php

namespace Modules\Location\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Location\Models\Location;
use Modules\Location\Http\Requests\StoreLocation;
use Modules\Location\Http\Requests\UpdateLocation;

class LocationController extends Controller
{
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
        
        return response()->json([
            'message' => 'Registros exitosos',
            'data' => $locations,
            'status' => 200,
            'success' => true,
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocation $request) {
        $validated = $request->validated();

        $location = Location::create($validated);

        if (!$location) {
            return response()->json([
                'message' => 'Error al crear el registro',
                'data' => null,
                'status' => 500,
                'success' => false,
            ],500);
        }

        return response()->json([
            'message' => 'Registro exitoso',
            'data' => $location,
            'status' => 200,
            'success' => true,
        ],200);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $location = Location::find($id);

        if (!$location) {
            return response()->json([
                'message' => 'Registro no encontrado',
                'data' => null,
                'status' => 404,
                'success' => false,
            ],404);
        }

        return response()->json([
            'message' => 'Registro exitoso',
            'data' => $location,
            'status' => 200,
            'success' => true,
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocation $request, $id) {
        $validated = $request->validated();

        $location = Location::find($id);

        if (!$location) {
            return response()->json([
                'message' => 'Registro no encontrado',
                'data' => null,
                'status' => 404,
                'success' => false,
            ],404);
        }

        $location->update($validated);

        return response()->json([
            'message' => 'Registro exitoso',
            'data' => $location,
            'status' => 200,
            'success' => true,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $location = Location::find($id);

        if (!$location) {
            return response()->json([
                'message' => 'Registro no encontrado',
                'data' => null,
                'status' => 404,
                'success' => false,
            ],404);
        }

        $location->delete();

        return response()->json([
            'message' => 'Registro exitoso',
            'data' => $location,
            'status' => 200,
            'success' => true,
        ],200);
    }
}
