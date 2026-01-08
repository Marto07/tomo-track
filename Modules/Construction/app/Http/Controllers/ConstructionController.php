<?php

namespace Modules\Construction\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Construction\Models\Construction;
use Modules\Core\Traits\ApiResponse;

class ConstructionController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Construction::query();
        //filtros aqui
        $data = $query->paginate($request->input('per_page', 10));
        return $this->PaginatedResponse($data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:255',
            'construction_type_id' => 'nullable|exists:construction_types,id',
            'status' => 'required|string|max:255', //despues puede ser un enum
            'start_date' => 'required|date',
            'estimated_end_date' => 'required|date|after_or_equal:start_date',
            'actual_end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'budget' => 'nullable|numeric|min:0',
            'progress' => 'nullable|numeric|between:0,100',
        ]);

        $construction = Construction::create($validated);

        if (!$construction) {
            return $this->ErrorResponse('Error al crear la construcción');
        }

        return $this->SuccessResponse($construction);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $construction = Construction::find($id);
        if (!$construction) {
            return $this->ErrorResponse('Construcción no encontrada');
        }
        return $this->SuccessResponse($construction);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'code' => 'sometimes|string|max:255',
            'construction_type_id' => 'nullable|exists:construction_types,id',
            'status' => 'sometimes|string|max:255', //despues puede ser un enum
            'start_date' => 'sometimes|date',
            'estimated_end_date' => 'sometimes|date|after_or_equal:start_date',
            'actual_end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'budget' => 'nullable|numeric|min:0',
            'progress' => 'nullable|numeric|between:0,100',
        ]);

        $construction = Construction::find($id);
        if (!$construction) {
            return $this->ErrorResponse('Construcción no encontrada');
        }
        $construction->update($validated);

        return $this->SuccessResponse($construction);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $construction = Construction::find($id);
        if (!$construction) {
            return $this->ErrorResponse('Construcción no encontrada');
        }
        $construction->delete();
        return $this->SuccessResponse(null, 'Construcción eliminada correctamente');
    }
    
}

