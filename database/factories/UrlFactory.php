<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Url>
 */
class UrlFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $url = 'https://www.darija-coding.com';
        return [
            //
            'full_url' => $url,
            'shorten_url' => Str::random(),
            'url_desc' => fake()->paragraph(),
            'user_id' => 1
        ];
    }
}
