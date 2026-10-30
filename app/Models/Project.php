<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'project_number',
        'tagline',
        'category',
        'year',
        'role',
        'project_type',
        'client',
        'short_description',
        'description',
        'challenge',
        'solution',
        'cover_image',
        'live_url',
        'github_url',
        'metrics',
        'api_demo',
        'featured',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'metrics' => 'array',
        'api_demo' => 'array',
        'featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function features(): HasMany
    {
        return $this->hasMany(ProjectFeature::class)->orderBy('sort_order');
    }

    public function technologies(): HasMany
    {
        return $this->hasMany(ProjectTechnology::class)->orderBy('sort_order');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order');
    }

    public function challenges(): HasMany
    {
        return $this->hasMany(ProjectChallenge::class)->orderBy('sort_order');
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('id', 'asc');
    }

    public function getCoverImageUrlAttribute(): ?string
    {
        if (!$this->cover_image) {
            return null;
        }

        if (\Illuminate\Support\Str::startsWith($this->cover_image, ['http://', 'https://'])) {
            return $this->cover_image;
        }

        if (\Illuminate\Support\Str::startsWith($this->cover_image, 'projects/')) {
            return asset('storage/' . $this->cover_image);
        }

        return asset($this->cover_image);
    }
}
