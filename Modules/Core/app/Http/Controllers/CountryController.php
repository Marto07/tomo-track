<?php

namespace Modules\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Core\Models\Country;
use Modules\Core\Traits\ApiResponse;

class CountryController extends Controller
{
    use ApiResponse;
    public function index(Request $request)
    {
        $query = Country::query();
        //filtros
        // if ($request->filled('name')) {
        //     $query->where('name', 'like', '%' . $request->input('name') . '%');
        // }
        $countries = $query->get();
        return $this->SuccessResponse($countries);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:countries,code',
        ]);
        $country = Country::create($validated);
        return $this->SuccessResponse($country, 'Country created successfully');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $country = Country::find($id);
        if (!$country) {
            return $this->ErrorResponse('Country not found', 404);
        }
        return $this->SuccessResponse($country);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $country = Country::find($id);
        if (!$country) {
            return $this->ErrorResponse('Country not found', 404);
        }
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'code' => 'sometimes|required|string|max:10|unique:countries,code,' . $country->id,
        ]);
        $country->update($validated);
        return $this->SuccessResponse($country, 'Country updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $country = Country::find($id);
        if (!$country) {
            return $this->ErrorResponse('Country not found', 404);
        }
        $country->delete();
        return $this->SuccessResponse(null, 'Country deleted successfully');
    }
}
