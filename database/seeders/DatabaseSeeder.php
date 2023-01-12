<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Page\Page;
use App\Models\Page\PageBlock;
use App\Models\Page\PageHeader;
use App\Models\Page\PageLink;
use App\Models\Page\PageSocial;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PlatformsSeeder::class);

        $john = \App\Models\User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'username' => 'john.doe'
        ]);

        $jane = \App\Models\User::factory()->create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'username' => 'jane.doe'
        ]);


    }
}
