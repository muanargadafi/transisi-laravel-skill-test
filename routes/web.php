<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('companies/select', [CompanyController::class, 'select'])->name('companies.select');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resource('companies', CompanyController::class);

    Route::get('/companies/{company}/logo', function (Company $company) {
        $media = $company->getFirstMedia(Company::MEDIA_COLLECTION);

        if (! $media || ! file_exists($media->getPath())) {
            abort(404);
        }

        return response()->file($media->getPath());
    })->name('companies.logo');

    Route::get('employees/import', [EmployeeController::class, 'importForm'])->name('employees.import-form');
    Route::post('employees/import', [EmployeeController::class, 'import'])->name('employees.import');
    Route::post('employees/export', [EmployeeController::class, 'export'])->name('employees.export');

    Route::resource('employees', EmployeeController::class);
});
