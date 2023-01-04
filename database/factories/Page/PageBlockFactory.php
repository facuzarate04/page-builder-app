<?php

namespace Database\Factories\Page;

use App\Models\Page\Page;
use App\Models\Page\PageHeader;
use App\Models\Page\PageLink;
use App\Models\Page\PageSocial;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page\PageBlock>
 */
class PageBlockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $blockable = Arr::random([PageHeader::class, PageLink::class, PageSocial::class]);

        return [
            'page_id' => Page::factory(),
            'order' => $this->faker->numberBetween(1, 3),
            'blockable_type' => $blockable,
            'blockable_id' => $blockable::factory(),
        ];
    }
}
