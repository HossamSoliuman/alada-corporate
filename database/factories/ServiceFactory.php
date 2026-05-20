<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Lead;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true);
        return [
            'name'              => ucwords($name),
            'slug'              => Str::slug($name) . '-' . Str::random(4),
            'short_description' => $this->faker->sentence(12),
            'description'       => collect(range(1, 3))->map(fn() => '<p>' . $this->faker->paragraph(4) . '</p>')->join(''),
            'is_featured'       => $this->faker->boolean(30),
            'is_active'         => true,
            'order'             => $this->faker->numberBetween(1, 20),
        ];
    }
}
