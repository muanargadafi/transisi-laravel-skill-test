<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employees';

    protected $fillable = [
        'company_id',
        'name',
        'email',
    ];

    /**
     * Get the company that owns this employee.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    #[Scope]
    protected function filter(Builder $query, string $search): void
    {
        $query->when($search ?? null, fn ($q) => $q->where('name', 'like', "%{$search}%"));
    }
}
