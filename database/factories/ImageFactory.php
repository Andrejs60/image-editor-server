<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "user_id" => 1,
            "name" => fake()->name(),
            "image_path" => "images\pMK8FlXoDRY9XrWXQMbWkiagoCeRC7tnLnrAl8cF.png"
        ];
    }
}
