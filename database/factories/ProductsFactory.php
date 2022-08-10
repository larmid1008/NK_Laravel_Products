<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function definition(): array
    {
        return [
            "title"        => $this->faker->sentence(random_int(1, 3)),
            "description"  => $this->faker->realTextBetween(150, 250),
            "price"        => $this->faker->randomFloat(2, 1, 300),
            "image_url"    => $this->faker->imageUrl(800, 800),
            "published_at" => random_int(0, 1) ? $this->faker->dateTimeBetween("-5 years", "now") : null,
        ];
    }
}
