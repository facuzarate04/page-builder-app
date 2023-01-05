<?php

namespace Database\Seeders;

use App\Models\Platform;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlatformsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Platform::factory()->create([
            'name' => 'Facebook',
            'url' => 'https://facebook.com'
        ]);

        Platform::factory()->create([
            'name' => 'Twitter',
            'url' => 'https://twitter.com'
        ]);

        Platform::factory()->create([
            'name' => 'Instagram',
            'url' => 'https://instagram.com'
        ]);

        Platform::factory()->create([
            'name' => 'LinkedIn',
            'url' => 'https://linkedin.com'
        ]);

        Platform::factory()->create([
            'name' => 'YouTube',
            'url' => 'https://youtube.com'
        ]);

        Platform::factory()->create([
            'name' => 'GitHub',
            'url' => 'https://github.com'
        ]);
    }
}
