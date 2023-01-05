<?php

namespace App\Http\Controllers\Dashboard\PageSettings\PageSocial;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\PageBlockResource;
use App\Models\Platform;
use App\Services\PageSettings\PageSocialService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class PageSocialController extends Controller
{
    public function index(PageSocialService $pageSocialService)
    {
        try {
            $block = auth()->user()->page->blocks()
                ->socialBlock()
                ->with([
                    'blockable.page.owner',
                    'blockable.socialLinks.platform'
                ])
                ->first();

            $platforms = Platform::all();

            if(!$block?->blockable)
            {
                $pageSocial = $pageSocialService->store(auth()->user()->page);
                $block = $pageSocial->block->load([
                    'blockable.page.owner',
                    'blockable.socialLinks.platform'
                ]);
            }

            foreach ($block->blockable->socialLinks as $socialLink) {
                $platforms->find($socialLink->platform_id)->username = $socialLink->username;
            }

            

        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->with('error', 'Something went wrong');
        }
        
        return Inertia::render('PageSettings/PageSocial/Index', [
            'block' => PageBlockResource::make($block),
            'pageSocial' => $block->blockable,
            'socialLinks' => $block->blockable->socialLinks,
            'platforms' => $platforms
        ]);
    }
}
