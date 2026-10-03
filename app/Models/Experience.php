<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'company',
        'position',
        'period',
        'stack',
        'start_date',
        'end_date',
        'is_current',
        'description',
        'location',
        'sort_order',
    ];

    protected $casts = [
        'is_current' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'sort_order' => 'integer',
    ];

    public function points(): HasMany
    {
        return $this->hasMany(ExperiencePoint::class)->orderBy('sort_order');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
