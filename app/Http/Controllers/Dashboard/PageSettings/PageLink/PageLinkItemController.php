<?php

namespace App\Http\Controllers\Dashboard\PageSettings\PageLink;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PageSettings\PageLink\StorePageLinkItemRequest;
use App\Http\Requests\Dashboard\PageSettings\PageLink\UpdatePageLinkItemRequest;
use App\Models\Page\PageLink;
use App\Services\PageSettings\PageLinkItemService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PageLinkItemController extends Controller
{
    public function store(StorePageLinkItemRequest $request, PageLink $pageLink, PageLinkItemService $pageLinkItemService)
    {
        try {
            $data = $request->validated();
            $pageLinkItemService->store($pageLink, $data);
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
