<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Company extends Model implements HasMedia
{
    use InteractsWithMedia;

    public const MEDIA_COLLECTION = 'media';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'companies';

    protected $fillable = [
        'name',
        'email',
        'website',
    ];

    public function getFileObjAttribute()
    {
        $media = $this->getFirstMedia(self::MEDIA_COLLECTION);

        return (object) [
            'file_path' => route('companies.logo', $this->id),
            'file_title' => $media ? $media->file_name : '',
            'download_path' => $media ? $media->getPath() : '',
        ];
    }

    /**
     * Get the employees for this company.
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    #[Scope]
    protected function filter(Builder $query, string $search): void
    {
        $query->when($search ?? null, fn ($q) => $q->where('name', 'like', "%{$search}%"));
    }

    /**
     * Defining media collections
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::MEDIA_COLLECTION)
            ->singleFile()
            ->useDisk('company_disk');
    }
}
