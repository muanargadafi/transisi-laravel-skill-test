<?php

namespace App\Services;

use App\Imports\EmployeeImport;
use App\Models\Employee;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeService
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    /**
     * Get a paginated list of employee.
     */
    public function getList(string $search, int $pagination = 5): LengthAwarePaginator
    {
        return Employee::with('company')
            ->latest()
            ->filter($search)
            ->paginate($pagination)
            ->withQueryString();
    }

    /**
     * Create a new employee.
     */
    public function create(array $data): void
    {
        DB::transaction(function () use ($data) {
            Employee::create([
                'company_id' => $data['company_id'],
                'name' => $data['name'],
                'email' => $data['email'],
            ]);
        });
    }

    /**
     * Update an existing employee.
     */
    public function update(Employee $employee, array $data): void
    {
        DB::transaction(function () use ($employee, $data) {
            $employee->update([
                'company_id' => $data['company_id'],
                'name' => $data['name'],
                'email' => $data['email'],
            ]);
        });
    }

    /**
     * Delete a employee.
     */
    public function delete(Employee $employee): void
    {
        DB::transaction(function () use ($employee) {
            $employee->delete();
        });
    }

    /**
     * Export employee data to PDF.
     */
    public function export(array $data): Response
    {
        $datas = Employee::with('company')
            ->when($data['company_id'] ?? null, function ($query, $companyId) {
                return $query->where('company_id', $companyId);
            })
            ->latest()
            ->get();

        $pdf = SnappyPdf::loadView('employee.pdf', compact('datas'));

        $pdf->setOption('page-size', 'A4')
            ->setOption('orientation', 'Portrait')
            ->setOption('margin-top', '15mm')
            ->setOption('margin-bottom', '15mm');

        return $pdf->download('laporan-data-employee.pdf');
    }

    public function import(array $data)
    {
        DB::transaction(function () use ($data) {
            $companyId = $data['company_id'];
            $file = $data['file_excel'];

            Excel::import(new EmployeeImport($companyId), $file);
        });
    }
}
