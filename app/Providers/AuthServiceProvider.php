<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Page\Links\PageLinkItem;
use App\Models\Page\PageHeader;
use App\Policies\Dashboard\PageSettings\PageHeader\PageHeaderPolicy;
use App\Policies\Dashboard\PageSettings\PageLink\PageLinkItemPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        PageLinkItem::class => PageLinkItemPolicy::class,
        PageHeader::class => PageHeaderPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
