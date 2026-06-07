<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class CompanyService
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    /**
     * Get a paginated list of company.
     */
    public function getList(string $search, int $pagination = 5): LengthAwarePaginator
    {
        return Company::latest()
            ->filter($search)
            ->paginate($pagination)
            ->withQueryString();
    }

    /**
     * Create a new company.
     */
    public function create(array $data): void
    {
        DB::transaction(function () use ($data) {
            $company = Company::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'website' => $data['website'],
            ]);

            if (isset($data['logo']) && $data['logo'] instanceof UploadedFile) {
                $company->addMedia($data['logo'])->toMediaCollection(Company::MEDIA_COLLECTION);
            }
        });
    }

    /**
     * Update an existing company.
     */
    public function update(Company $company, array $data): void
    {
        DB::transaction(function () use ($company, $data) {
            $company->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'website' => $data['website'],
            ]);

            if (isset($data['logo']) && $data['logo'] instanceof UploadedFile) {
                $company->addMedia($data['logo'])->toMediaCollection(Company::MEDIA_COLLECTION);
            }
        });
    }

    /**
     * Delete a company.
     */
    public function delete(Company $company): void
    {
        DB::transaction(function () use ($company) {
            $company->employees()->delete();
            $company->delete();
        });
    }
}
