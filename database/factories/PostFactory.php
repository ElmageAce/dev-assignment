<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    final public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->words(6, true),
            'description' => $this->faker->realText(500),
            'publication_date' => now()->addDays(mt_rand(0, 30)),
            'slug' => $this->faker->unique()->slug,
        ];
    }
}
