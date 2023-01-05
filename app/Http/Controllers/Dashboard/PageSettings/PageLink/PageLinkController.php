<?php

namespace App\Http\Controllers\Dashboard\PageSettings\PageLink;

use App\Http\Controllers\Controller;
use App\Services\PageSettings\PageLinkService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class PageLinkController extends Controller
{
    public function index(PageLinkService $pageLinkService)
    {
        try {
            $block = auth()->user()->page->blocks()
                ->linkBlock()
                ->with([
                    'blockable.page.owner',
                    'blockable.linkItems'
                ])
                ->first();

            if(!$block?->blockable)
            {
                $pageLink = $pageLinkService->store(auth()->user()->page);
                $block = $pageLink->block->load([
                    'blockable.page.owner',
                    'blockable.linkItems'
                ]);
            }

        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->with('error', 'Something went wrong');
        }
        
        return Inertia::render('PageSettings/PageLink/Index', [
            'pageLink' => $block->blockable,
            'links' => $block->blockable->linkItems
        ]);
    }
}
