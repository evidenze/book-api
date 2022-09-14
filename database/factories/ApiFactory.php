<?php

namespace Database\Factories;

use App\Models\BooksModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ApiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BooksModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'            => fake()->name(),
            'isbn'            => '1234',
            'authors'         => fake()->name(),
            'country'         => 'Nigeria',
            'number_of_pages' => 1234,
            'publisher'       => fake()->name(),
            'release_date'    => fake()->date()
        ];
    }
}
