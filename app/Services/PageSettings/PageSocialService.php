<?php

namespace App\Services\PageSettings;

use App\Models\Page\Page;
use App\Models\Page\PageSocial;
use Illuminate\Support\Facades\DB;

class PageSocialService
{

    public function store(Page $page): PageSocial
    {
        DB::beginTransaction();
        try {
            $pageSocial = PageSocial::create([
                'page_id' => $page->id
            ]);

            $pageSocial->block()->create([
                'page_id' => $page->id
            ]);
            
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return $pageSocial;
    }

    public function update(PageSocial $pageSocial, array $data): PageSocial
    {
        DB::beginTransaction();
        try {
            $pageSocial->update($data);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return $pageSocial;
    }

}