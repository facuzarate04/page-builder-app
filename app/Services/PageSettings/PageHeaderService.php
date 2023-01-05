<?php

namespace App\Services\PageSettings;

use App\Models\Page\Page;
use App\Models\Page\PageHeader;
use Illuminate\Support\Facades\DB;

class PageHeaderService
{

    public function store(Page $page): PageHeader
    {
        DB::beginTransaction();
        try {
            $header = PageHeader::create([
                'page_id' => $page->id
            ]);

            $header->block()->create([
                'page_id' => $page->id
            ]);
            
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return $header;
    }

    public function update(PageHeader $pageHeader, array $data): PageHeader
    {
        DB::beginTransaction();
        try {
            $pageHeader->update($data);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return $pageHeader;
    }

}