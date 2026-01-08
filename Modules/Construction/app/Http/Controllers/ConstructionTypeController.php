<?php

namespace Modules\Construction\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Construction\Models\ConstructionType;
use Modules\Core\Traits\ApiResponse;

class ConstructionTypeController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->successResponse(ConstructionType::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:construction_types,name',
            'description' => 'nullable|string|max:500',
        ]);
        $constructionType = ConstructionType::create($validated);
        if (!$constructionType) {
            return $this->errorResponse('Failed to create Construction Type', 500);
        }
        return $this->successResponse($constructionType, 'Construction type successfully created', 201);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $constructionType = ConstructionType::find($id);
        if (!$constructionType) {
            return $this->errorResponse('Construction Type not found', 404);
        }
        return $this->successResponse($constructionType, 'Construction Type retrieved successfully');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:100|unique:construction_types,name,' . $id,
            'description' => 'nullable|string|max:500',
        ]);
        $constructionType = ConstructionType::find($id);
        if (!$constructionType) {
            return $this->errorResponse('Construction Type not found', 404);
        }
        $constructionType->update($validated);
        return $this->successResponse($constructionType, 'Construction Type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $constructionType = ConstructionType::find($id);
        if (!$constructionType) {
            return $this->errorResponse('Construction Type not found', 404);
        }
        $constructionType->delete();
        return $this->successResponse(null, 'Construction Type deleted successfully');
    }
}
