<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->paragraph(),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Post $post) {
            if (random_int(1, 15) > 13) {
                $imageUrl = $this->faker->imageUrl(900, 550, Str::random(5), true);
                $post->addMediaFromUrl($imageUrl)->toMediaCollection('images');
            }
        });
    }
}
