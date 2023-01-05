<?php

namespace App\Http\Controllers\Dashboard\PageSettings\PageSocial;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PageSettings\UpsertPageSocialLinksRequest;
use App\Models\Page\PageSocial;
use App\Services\PageSettings\PageSocialLinkService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UpsertPageSocialLinksController extends Controller
{
    public function __invoke(UpsertPageSocialLinksRequest $request, PageSocial $pageSocial, PageSocialLinkService $pageSocialLinkService)
    {
        try {
            $data = $request->validated();
            $platforms = $data['platforms'];
            foreach ($platforms as $platform) {
                if(isset($platform['username']))
                    $pageSocialLinkService->upsert($pageSocial, $platform);
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->with('error', 'Something went wrong');
        }
        return redirect()->back()->with('success', 'Social links updated');
    }
}
