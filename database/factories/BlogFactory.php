<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Lead;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(6);
        return [
            'blog_category_id' => BlogCategory::inRandomOrder()->first()?->id,
            'user_id'          => User::where('is_admin', true)->first()?->id,
            'title'            => $title,
            'slug'             => Str::slug($title) . '-' . Str::random(4),
            'excerpt'          => $this->faker->paragraph(2),
            'content'          => collect(range(1, 5))->map(fn() => '<p>' . $this->faker->paragraph(5) . '</p>')->join(''),
            'is_featured'      => $this->faker->boolean(20),
            'is_published'     => true,
            'published_at'     => $this->faker->dateTimeBetween('-1 year'),
            'views_count'      => $this->faker->numberBetween(0, 5000),
            'reading_time'     => $this->faker->numberBetween(2, 12),
        ];
    }
}
