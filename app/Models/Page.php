<?php

namespace App\Models;

use App\Models\Traits\HasSeoMeta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    use HasSeoMeta;

    protected $fillable = [
        'slug', 'title', 'subtitle', 'content',
        'sections', 'featured_image', 'is_published', 'published_at',
    ];

    protected $casts = [
        'sections' => 'array',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function cards(): HasMany
    {
        return $this->hasMany(PageCard::class)->orderBy('order')->orderBy('id');
    }
}
