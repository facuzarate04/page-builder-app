<?php

namespace App\Services\PageSettings;

use App\Models\Page\Links\PageLinkItem;
use App\Models\Page\Page;
use App\Models\Page\PageLink;
use Illuminate\Support\Facades\DB;

class PageLinkItemService
{
    public function store(PageLink $page, array $data): PageLinkItem
    {
        DB::beginTransaction();
        try {
            $data['order'] = $page->linkItems()->max('order') + 1;
            $pageLinkItem = $page->linkItems()->create($data);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return $pageLinkItem;
    }
}