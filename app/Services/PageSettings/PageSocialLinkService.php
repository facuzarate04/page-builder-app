<?php

namespace App\Services\PageSettings;

use App\Models\Page\Page;
use App\Models\Page\PageSocial;
use App\Models\Page\Socials\PageSocialLink;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PageSocialLinkService
{
    public function upsert(PageSocial $pageSocial, array $data): PageSocialLink
    {
        DB::beginTransaction();
        try {
            $pageSocialLink = PageSocialLink::updateOrCreate(
                [
                    'page_social_id' => $pageSocial->id,
                    'platform_id' => $data['id']
                ],
                [
                    'username' => $data['username']
                ]
            );

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return $pageSocialLink;
    }
}