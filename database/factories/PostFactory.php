<?php

namespace DissanayajeG\pack\Database\Factories;

use DissanayajeG\pack\Models\Post;
use DissanayakeG\pack\Tests\User;
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
        $author = User::factory()->create();

        return [
            'title'     => $this->faker->words(3, true),
            'body'      => $this->faker->paragraph,
            'author_id' => $author->id,
            'author_type' => get_class($author)
        ];
    }
}
