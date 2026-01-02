<?php

namespace Modules\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Core\Traits\ApiResponse;
use Modules\Core\Models\State;

class StateController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = State::query();

         
        if ($request->filled('filter')) {
            $query->where('name', 'LIKE', '%' . $request->input('filter') . '%')
                ->orWhere('code', 'LIKE', '%' . $request->input('filter') . '%');
        }

        if ($request->filled('country_id')) {
            $query->where('country_id', $request->input('country_id'));
        }
       
        $states = $query->get();

        return $this->SuccessResponse($states);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:states,code',
            'country_id' => 'required|integer|exists:countries,id',
        ]);

        $state = State::create($validated);

        if (!$state) return $this->ErrorResponse('Failed to create state', 500);

        return $this->SuccessResponse($state, 'State created successfully');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $state = State::find($id);
        if (!$state) {
            return $this->ErrorResponse('state not found', 404);
        }
        return $this->SuccessResponse($state);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $state = State::find($id);
        if (!$state) {
            return $this->ErrorResponse('state not found', 404);
        }
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'code' => 'sometimes|required|string|max:10|unique:states,code,' . $state->id,
            'country_id' => 'sometimes|required|integer|exists:countries,id',
        ]);

        $state->update($validated);
        return $this->SuccessResponse($state, 'state updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $state = State::find($id);
        if (!$state) {
            return $this->ErrorResponse('state not found', 404);
        }
        $state->delete();
        return $this->SuccessResponse(null, 'state deleted successfully');
    }
}
