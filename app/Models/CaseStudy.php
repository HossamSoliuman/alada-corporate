<?php

namespace App\Models;

use App\Models\Traits\HasSeoMeta;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class CaseStudy extends Model
{
    use HasSeoMeta, HasSlug;

    protected $fillable = [
        'case_study_category_id', 'industry_id', 'title', 'slug',
        'client_name', 'client_logo', 'challenge', 'solution', 'result',
        'featured_image', 'gallery', 'pdf_file', 'cta_title', 'cta_text',
        'cta_link', 'is_featured', 'is_published', 'published_at', 'order',
    ];

    protected $casts = [
        'gallery' => 'array',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }

    public function category()
    {
        return $this->belongsTo(CaseStudyCategory::class, 'case_study_category_id');
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)->whereNotNull('published_at');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
