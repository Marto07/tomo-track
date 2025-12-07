<?php

namespace Modules\Item\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Item\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $query = Category::query();
        //filters
        /* 
            if($request->filled('search')) {
                $query->where('name', 'like', '%' . $request->search . '%');
            } 
        */

        $stockItems = $query->paginate($perPage);

        return response()->json([
            'data' => $stockItems->items(),
            'meta' => [
                'total' => $stockItems->total(),
                'per_page' => $stockItems->perPage(),
                'current_page' => $stockItems->currentPage(),
                'last_page' => $stockItems->lastPage(),
            ],
            'links' => [
                'first' => $stockItems->url(1),
                'last' => $stockItems->url($stockItems->lastPage()),
                'prev' => $stockItems->previousPageUrl(),
                'next' => $stockItems->nextPageUrl(),
            ],
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        return response()->json([]);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        //

        return response()->json([]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //

        return response()->json([]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        return response()->json([]);
    }
}
