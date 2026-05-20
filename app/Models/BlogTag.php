<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class BlogTag extends Model
{
    use HasSlug;

    protected $fillable = ['name', 'slug'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'blog_tag', 'blog_tag_id', 'blog_id');
    }
}
