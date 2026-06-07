<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportEmployeeRequest;
use App\Http\Requests\SaveEmployeeRequest;
use App\Models\Employee;
use App\Services\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Create a new class instance.
     */
    public function __construct(private EmployeeService $employeeService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->string('search')->trim();

        $datas = $this->employeeService->getList($search);

        return view('employee.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveEmployeeRequest $request)
    {
        try {
            $this->employeeService->create($request->validated());

            $message = ['success' => 'Employee created successfully'];
        } catch (\Exception $e) {
            $message = ['error' => $e->getMessage()];
        }

        return redirect(route('employees.index'))->with($message);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view('employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('employee.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaveEmployeeRequest $request, Employee $employee)
    {
        try {
            $this->employeeService->update($employee, $request->validated());

            $message = ['success' => 'Employee updated successfully'];
        } catch (\Exception $e) {
            $message = ['error' => $e->getMessage()];
        }

        return redirect(route('employees.index'))->with($message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try {
            $this->employeeService->delete($employee);

            $message = ['success' => 'Employee deleted successfully'];
        } catch (\Exception $e) {
            $message = ['error' => $e->getMessage()];
        }

        return to_route('employees.index')->with($message);
    }

    public function importForm(Request $request)
    {
        return view('employee.import');
    }

    public function import(ImportEmployeeRequest $request)
    {
        try {
            $this->employeeService->import($request->validated());

            $message = ['success' => 'Employee import successfully'];
        } catch (\Exception $e) {
            $message = ['error' => $e->getMessage()];
        }

        return redirect(route('employees.index'))->with($message);
    }

    public function export(Request $request)
    {
        $validatedData = $request->all('company_id');

        return $this->employeeService->export($validatedData);
    }
}
