<?php

namespace Modules\Location\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Location\Models\LocationType;
use Modules\Core\Traits\ApiResponse;

class LocationTypeController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->SuccessResponse(LocationType::all());
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:300',
        ]);
        $locationType = LocationType::create($validated);
        return $this->SuccessResponse($locationType, 201);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $locationType = LocationType::find($id);
        if (!$locationType) {
            return $this->ErrorResponse('Location Type not found', 404);   
        }
        return $this->SuccessResponse($locationType);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:100',
            'description' => 'sometimes|nullable|string|max:300',
        ]);
        $locationType = LocationType::find($id);
        if (!$locationType) {
            return $this->ErrorResponse('Location Type not found', 404);
        }
        $locationType->update($validated);
        return $this->SuccessResponse($locationType);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $locationType = LocationType::find($id);
        if (!$locationType) {
            return $this->ErrorResponse('Location Type not found', 404);
        }
        $locationType->delete();
        return $this->SuccessResponse(null, 204);
    }
}
