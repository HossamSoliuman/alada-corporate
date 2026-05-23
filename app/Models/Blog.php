<?php

namespace App\Models;

use App\Models\Traits\HasSeoMeta;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Blog extends Model
{
    use HasSlug, HasSeoMeta;

    protected $fillable = [
        'blog_category_id', 'user_id', 'title', 'slug', 'excerpt',
        'content', 'featured_image', 'is_featured', 'is_published',
        'published_at', 'views_count', 'reading_time',
    ];

    protected $casts = [
        'is_featured'  => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(BlogTag::class, 'blog_tag', 'blog_id', 'blog_tag_id');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)->whereNotNull('published_at');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getReadingTimeAttribute(): int
    {
        if ($this->attributes['reading_time'] ?? null) {
            return (int) $this->attributes['reading_time'];
        }
        $words = str_word_count(strip_tags($this->content ?? ''));
        return max(1, (int) ceil($words / 200));
    }
}
