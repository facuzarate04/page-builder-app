<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IndexPageController extends Controller
{
    public function __invoke(string $username)
    {
        $owner = User::where('username', $username)->firstOrFail();

        return Inertia::render('MyPage/Index', [
            'owner' => $owner
        ]);
    }
}
