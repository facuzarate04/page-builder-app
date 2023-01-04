<?php

namespace Database\Factories\Page;

use App\Models\Page\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page\PageHeader>
 */
class PageHeaderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'page_id' => Page::factory(),
            'title' => $this->faker->sentence,
            'subtitle' => $this->faker->sentence,
        ];
    }
}
