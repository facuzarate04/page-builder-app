<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\PageBlockResource;
use App\Models\Page\PageBlock;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IndexPageSettingsController extends Controller
{
    public function __invoke()
    {
        $blocks = PageBlock::where('page_id', auth()->user()->page->id)
            ->with('blockable')
            ->orderBy('order', 'asc')
            ->get();
            
        return Inertia::render('PageSettings/Index',[
            'blocks' => PageBlockResource::collection($blocks)
        ]);
    }
}
