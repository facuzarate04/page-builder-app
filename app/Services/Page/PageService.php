<?php

namespace App\Services\Page;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class PageService
{

    public function store(User $owner)
    {
        DB::beginTransaction();
        try {
            $owner->page()->create();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

}