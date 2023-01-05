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

        $john = \App\Models\User::factory()->has(
            Page::factory(),
            'page'
        )->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'username' => 'john.doe'
        ]);

        $pageHeader = PageHeader::factory()->create([
            'page_id' => $john->page->id
        ]);
        $pageLink = PageLink::factory()->create([
            'page_id' => $john->page->id
        ]);
        $pageSocial = PageSocial::factory()->create([
            'page_id' => $john->page->id
        ]);
        
        $pageHeader->block()->create([
            'page_id' => $john->page->id,
            'order' => 1
        ]);
        $pageLink->block()->create([
            'page_id' => $john->page->id,
            'order' => 2
        ]);
        $pageSocial->block()->create([
            'page_id' => $john->page->id,
            'order' => 3
        ]);


        $jane = \App\Models\User::factory()->create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'username' => 'jane.doe'
        ]);


    }
}
