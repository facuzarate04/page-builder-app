<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\IndexPageSettingsController;
use App\Http\Controllers\Dashboard\PageSettings\PageHeader\PageHeaderController;
use App\Http\Controllers\Dashboard\PageSettings\PageLink\PageLinkController;
use App\Http\Controllers\Dashboard\PageSettings\PageLink\PageLinkItemController;
use App\Http\Controllers\Dashboard\PageSettings\PageLink\UpdatePageLinkItemsOrderController;
use App\Http\Controllers\Dashboard\PageSettings\PageSocial\PageSocialController;
use App\Http\Controllers\Dashboard\PageSettings\PageSocial\UpsertPageSocialLinksController;
use App\Http\Controllers\Dashboard\SettingsPage\UpdateBlocksOrderController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Dashboard');
})->name('index');

Route::prefix('page')->name('page.')->middleware(['has.page'])->group(function(){
    Route::get('/', IndexPageSettingsController::class)->name('index');
    Route::put('/', UpdateBlocksOrderController::class)->name('order');

    Route::name('header.')->prefix('header')->group(function(){
        Route::get('/', [PageHeaderController::class, 'index'])->name('index');
        Route::put('{pageHeader}', [PageHeaderController::class, 'update'])->name('update');
    });
    Route::name('social.')->prefix('social')->group(function(){
        Route::get('/', [PageSocialController::class, 'index'])->name('index');
        Route::name('links.')->prefix('{pageSocial}/links')->group(function(){
            Route::put('/', UpsertPageSocialLinksController::class)->name('upsert');
        });
    });
    Route::name('link.')->prefix('link')->group(function(){
        Route::get('/', [PageLinkController::class, 'index'])->name('index');
        Route::name('items.')->prefix('{pageLink}/items')->group(function(){
            Route::post('/', [PageLinkItemController::class, 'store'])->name('store');
            Route::put('/', UpdatePageLinkItemsOrderController::class)->name('order');
        });
    });

});