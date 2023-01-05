<?php

namespace App\Http\Middleware;

use App\Services\PageSettings\PageService;
use Closure;
use Illuminate\Http\Request;

class HasPageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!auth()->user()->page()->exists())
        {
            $pageService = new PageService();
            $pageService->store(auth()->user());
        }
        return $next($request);
    }
}
