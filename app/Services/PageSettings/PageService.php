<?php

namespace App\Services\PageSettings;

use App\Models\Page\Page;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PageService
{

    public function store(User $owner): Page
    {
        DB::beginTransaction();
        try {
            $page = $owner->page()->create();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return $page;
    }

}