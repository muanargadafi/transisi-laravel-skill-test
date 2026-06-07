<?php

namespace App\Imports;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterBatch;

class EmployeeImport implements ToModel, WithBatchInserts, WithChunkReading, WithEvents, WithHeadingRow, WithValidation
{
    protected $companyId;

    private static $batchCount = 0;

    // Menerima company_id dari form input
    public function __construct($companyId)
    {
        $this->companyId = $companyId;
    }

    /**
     * @return Model|null
     */
    public function model(array $row)
    {
        if (empty($row['name']) && empty($row['email'])) {
            return null;
        }

        return new Employee([
            'name' => $row['name'],
            'company_id' => $this->companyId,
            'email' => $row['email'],
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterBatch::class => function (AfterBatch $event) {
                self::$batchCount++;
                Log::info('Batch ke-'.self::$batchCount.' berhasil diproses. Berisi '.$event->getBatchSize().' baris.');
            },
        ];
    }

    public function batchSize(): int
    {
        return 10;
    }

    public function chunkSize(): int
    {
        return 10;
    }
}
