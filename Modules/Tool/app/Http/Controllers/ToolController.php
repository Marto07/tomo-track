<?php

namespace Modules\Tool\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Core\Traits\ApiResponse;
use Modules\Tool\Http\Requests\StoreToolRequest;
use Modules\Tool\Http\Requests\UpdateToolRequest;
use Modules\Tool\Models\Tool;


class ToolController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Tool::query();
        /*  
            ==========================
            filtros
            ==========================
        */
        $query->with('category');
        $items = $query->paginate(10);

        if(!$items) return $this->ErrorResponse("Error al obtener los items", 404);

        return $this->PaginatedResponse($items);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreToolRequest $request) {
        $validated = $request->validated();
        $item = Tool::create($validated);
        if(!$item) return $this->ErrorResponse(null, 404);
        return $this->SuccessResponse($item);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $item = Tool::with('category')->find($id);
        if(!$item) return $this->ErrorResponse(null, 404);
        return $this->SuccessResponse($item);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateToolRequest $request, $id) {
        $validated = $request->validated();
        $item = Tool::with('category')->find($id);
        if (!$item) return $this->ErrorResponse(null, 404);
        $item->update($validated);
        return $this->SuccessResponse($item);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $item = Tool::find($id);
        if (!$item) return $this->ErrorResponse(null, 404);
        $item->delete();
        return $this->SuccessResponse($item);
    }
}
