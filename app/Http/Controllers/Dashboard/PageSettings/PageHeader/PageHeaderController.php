<?php

namespace App\Http\Controllers\Dashboard\PageSettings\PageHeader;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PageSettings\UpdatePageHeaderRequest;
use App\Http\Resources\Dashboard\PageBlockResource;
use App\Models\Page\PageHeader;
use App\Services\PageSettings\PageHeaderService;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class PageHeaderController extends Controller
{
    public function index(PageHeaderService $pageHeaderService)
    {
        try {
            $block = auth()->user()->page->blocks()
                ->headerBlock()
                ->with('blockable.page.owner')
                ->first();

            if(!$block?->blockable)
            {
                $header = $pageHeaderService->store(auth()->user()->page);
                $block = $header->block->load('blockable.page.owner');
            }

        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->with('error', 'Something went wrong');
        }
        
        return Inertia::render('PageSettings/PageHeader/Index', [
            'block' => PageBlockResource::make($block),
            'header' => $block->blockable
        ]);
    }

    public function update(UpdatePageHeaderRequest $request, PageHeader $pageHeader, PageHeaderService $pageHeaderService)
    {
        try {
            $data = $request->validated();
            $pageHeaderService->update($pageHeader, $data);
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->with('error', 'Something went wrong');
        }

        return redirect()->back()->with('success', 'Page header updated successfully');
    }
}
