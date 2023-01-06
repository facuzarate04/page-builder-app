<?php

namespace App\Http\Controllers\Dashboard\PageSettings\PageLink;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PageSettings\PageLink\UpdatePageLinkItemsOrderRequest;
use App\Models\Page\PageLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UpdatePageLinkItemsOrderController extends Controller
{
    public function __invoke(UpdatePageLinkItemsOrderRequest $request, PageLink $pageLink)
    {
        try {
            $data = $request->validated();
            foreach ($data['links'] as $link) {
                $pageLink->linkItems()->where('id', $link['id'])
                    ->update(['order' => $link['order']]);
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->with('error', 'Something went wrong');
        }   

        return redirect()->back();
    }
}
