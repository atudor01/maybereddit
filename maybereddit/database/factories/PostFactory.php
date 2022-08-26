<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = fake()->sentence();
        $slug = Str::slug($title);
        return [
            'user_id' => rand(1,100),
            'title' => $title,
            'slug' => $slug,
            'body' => fake()->paragraph(rand(1, 5)),

        ];

    }
}
