<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveCompanyRequest;
use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Create a new class instance.
     */
    public function __construct(private CompanyService $companyService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->string('search')->trim();

        $datas = $this->companyService->getList($search);

        return view('company.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveCompanyRequest $request)
    {
        try {
            $this->companyService->create($request->validated());

            $message = ['success' => 'Company created successfully'];
        } catch (\Exception $e) {
            $message = ['error' => $e->getMessage()];
        }

        return redirect(route('companies.index'))->with($message);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return view('company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaveCompanyRequest $request, Company $company)
    {
        try {
            $this->companyService->update($company, $request->validated());

            $message = ['success' => 'Company updated successfully'];
        } catch (\Exception $e) {
            $message = ['error' => $e->getMessage()];
        }

        return redirect(route('companies.index'))->with($message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        try {
            $this->companyService->delete($company);

            $message = ['success' => 'Company deleted successfully'];
        } catch (\Exception $e) {
            $message = ['error' => $e->getMessage()];
        }

        return to_route('companies.index')->with($message);
    }

    public function select(Request $request)
    {
        $search = $request->string('search')->trim();

        $datas = $this->companyService->getList($search, 10);

        return response()->json([
            'results' => $datas->map(fn ($company) => [
                'id' => $company->id,
                'text' => $company->name,
            ]),
            'pagination' => [
                'more' => $datas->hasMorePages(),
            ],
        ]);
    }
}
