<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Lead;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LeadFactory extends Factory
{
    protected $model = Lead::class;

    public function definition(): array
    {
        return [
            'form_type'  => $this->faker->randomElement(['contact', 'inquiry', 'service_inquiry', 'callback']),
            'name'       => $this->faker->name(),
            'email'      => $this->faker->safeEmail(),
            'phone'      => $this->faker->phoneNumber(),
            'company'    => $this->faker->company(),
            'subject'    => $this->faker->sentence(4),
            'message'    => $this->faker->paragraph(3),
            'ip_address' => $this->faker->ipv4(),
            'status'     => $this->faker->randomElement(['new', 'contacted', 'qualified', 'converted', 'archived']),
        ];
    }
}
