<?php

namespace Modules\Company\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Company\Models\Company;
use Modules\Core\Traits\ApiResponse;

class CompanyController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Company::query();

        // Apply filters, sorting, pagination, etc. as needed

        $companies = $query->paginate($request->get('per_page', 10));

        return $this->paginatedResponse($companies);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'legal_name' => 'nullable|string|max:255',
            'tax_id' => 'nullable|string|max:100|unique:companies,tax_id',
            'logo' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:50',
        ]);

        $company = Company::create($validated);

        return $this->successResponse($company, 201);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $company = Company::with(['addresses', 'constructions'])->find($id);

        if (!$company) {
            return $this->errorResponse('Company not found', 404);
        }

        return $this->successResponse($company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $company = Company::find($id);

        if (!$company) {
            return $this->errorResponse('Company not found', 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'legal_name' => 'sometimes|nullable|string|max:255',
            'tax_id' => 'sometimes|nullable|string|max:100|unique:companies,tax_id,' . $company->id,
            'logo' => 'sometimes|nullable|string|max:255',
            'status' => 'sometimes|nullable|string|max:50',
        ]);

        $company->update($validated);

        return $this->successResponse($company);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $company = Company::find($id);

        if (!$company) {
            return $this->errorResponse('Company not found', 404);
        }

        $company->delete();

        return $this->successResponse(null, 204);
    }
}
