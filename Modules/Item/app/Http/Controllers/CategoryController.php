<?php

namespace Modules\Item\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Item\Models\Category;
use Modules\Core\Traits\ApiResponse;
use Modules\Item\Http\Requests\StoreCategory;
use Modules\Item\Http\Requests\UpdateCategory;


class CategoryController extends Controller
{
    use ApiResponse;
    /**
     * 
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
        $categories = $query->paginate($perPage);
        return $this->PaginatedResponse($categories);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategory $request)
    {
        $validated = $request->validated();
        $category = Category::create($validated);
        if(!$category) return $this->ErrorResponse(null, 404);
        return $this->SuccessResponse($category);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $category = Category::find($id);
        if(!$category) return $this->ErrorResponse(null, 404);
        return $this->SuccessResponse($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategory $request, $id)
    {
        $category = Category::find($id);
        if (!$category) return $this->ErrorResponse(null, 404);
        $validated = $request->validated();
        $category->update($validated);
        return $this->SuccessResponse($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) return $this->ErrorResponse(null, 404);
        $category = Category::destroy($id);
        return $this->SuccessResponse($category);
    }
}
