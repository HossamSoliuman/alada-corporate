<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class CaseStudyCategory extends Model
{
    use HasSlug;

    protected $fillable = ['name', 'slug', 'is_active', 'order'];
    protected $casts    = ['is_active' => 'boolean'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function caseStudies()
    {
        return $this->hasMany(CaseStudy::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }
}
