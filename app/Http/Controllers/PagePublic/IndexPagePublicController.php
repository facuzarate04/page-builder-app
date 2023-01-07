<?php

namespace App\Http\Controllers\PagePublic;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\PageBlockResource;
use App\Models\Page\PageLink;
use App\Models\Page\PageSocial;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Inertia\Inertia;

class IndexPagePublicController extends Controller
{
    public function __invoke(string $username)
    {
        $owner = User::where('username', $username)
            ->has('page.blocks')
            ->with([
                'page.blocks' => function($blocks) {
                    return $blocks
                        ->with([
                            'blockable' => function(MorphTo $morphTo) {
                                return $morphTo->morphWith([
                                    PageSocial::class => ['socialLinks.platform'],
                                    PageLink::class => ['linkItems']
                                ]);
                            }
                        ])
                        ->orderBy('order', 'asc');
                },
                
            ])
            ->firstOrFail();

        return Inertia::render('PagePublic/Index', [
            'owner' => $owner,
            'blocks' => PageBlockResource::collection($owner->page->blocks),
        ]);
    }
}
