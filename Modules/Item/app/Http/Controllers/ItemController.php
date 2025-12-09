<?php

namespace Modules\Item\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Item\Http\Requests\StoreItem;
use Modules\Core\Traits\ApiResponse;
use Modules\Item\Models\Item;

class ItemController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Item::query();
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
    public function store(StoreItem $request) {
        $validated = $request->validated();
        $item = Item::create($validated);
        if(!$item) return $this->ErrorResponse(null, 404);
        return $this->SuccessResponse($item);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $item = Item::with('category')->find($id);
        if(!$item) return $this->ErrorResponse(null, 404);
        return $this->SuccessResponse($item);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $validated = $request->validated();
        $item = Item::with('category')->find($id);
        if (!$item) return $this->ErrorResponse(null, 404);
        $item->update($validated);
        return $this->SuccessResponse($item);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $item = Item::find($id);
        if (!$item) return $this->ErrorResponse(null, 404);
        $item->delete();
        return $this->SuccessResponse($item);
    }
}
