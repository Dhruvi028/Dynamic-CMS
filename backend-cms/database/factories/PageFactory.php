<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Page;

class PageFactory extends Factory
{
    protected $model = Page::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'slug' => $this->faker->slug,
            'content' => $this->faker->paragraph,
            'parent_id' => null // Default to no parent
        ];
    }
}
