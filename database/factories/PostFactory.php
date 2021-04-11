<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image' => $this->faker->optional($weight = 0.7)->imageUrl(100, 100, 'cats') ,
            'title' => $this->faker->sentence(10),
            'body'  => $this->faker->sentence(30),
        ];
    }
}
