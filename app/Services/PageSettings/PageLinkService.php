<?php

namespace App\Services\PageSettings;

use App\Models\Page\Page;
use App\Models\Page\PageLink;
use Illuminate\Support\Facades\DB;

class PageLinkService
{
    public function store(Page $page): PageLink
    {
        DB::beginTransaction();
        try {
            $pageLink = PageLink::create([
                'page_id' => $page->id
            ]);

            $pageLink->block()->create([
                'page_id' => $page->id
            ]);
            
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return $pageLink;
    }
}