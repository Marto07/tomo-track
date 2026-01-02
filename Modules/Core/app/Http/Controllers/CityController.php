<?php

namespace Modules\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Core\Traits\ApiResponse;
use Modules\Core\Models\City;

class CityController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = City::query();

         
        if ($request->filled('filter')) {
            $query->where('name', 'LIKE', '%' . $request->input('filter') . '%')
                ->orWhere('postal_code', 'LIKE', '%' . $request->input('filter') . '%');
        }

        if ($request->filled('state_id')) {
            $query->where('state_id', $request->input('state_id'));
        }

        $cities = $query->get();
        return $this->SuccessResponse($cities);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10|unique:cities,postal_code',
            'state_id' => 'required|integer|exists:states,id',
        ]);

        $city = City::create($validated);
        if (!$city) { 
            return $this->ErrorResponse('Failed to create city', 500);
        }

        return $this->SuccessResponse($city, 'City created successfully');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $city = City::find($id);
        if (!$city) {
            return $this->ErrorResponse('city not found', 404);
        }
        return $this->SuccessResponse($city);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $city = City::find($id);
        if (!$city) {
            return $this->ErrorResponse('city not found', 404);
        }
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'postal_code' => 'sometimes|required|string|max:10|unique:cities,postal_code,' . $city->id,
            'state_id' => 'sometimes|required|integer|exists:states,id',
        ]);

        $city->update($validated);
        return $this->SuccessResponse($city, 'city updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $city = City::find($id);
        if (!$city) {
            return $this->ErrorResponse('city not found', 404);
        }
        $city->delete();
        return $this->SuccessResponse(null, 'city deleted successfully');
    }
}
