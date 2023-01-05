<?php

use App\Http\Controllers\Dashboard\IndexPageSettingsController;
use App\Http\Controllers\Dashboard\PageSettings\PageHeader\PageHeaderController;
use App\Http\Controllers\Dashboard\PageSettings\PageLink\PageLinkController;
use App\Http\Controllers\Dashboard\PageSettings\PageLink\PageLinkItemController;
use App\Http\Controllers\Dashboard\PageSettings\PageSocial\DeletePageSocialLinkController;
use App\Http\Controllers\Dashboard\PageSettings\PageSocial\PageSocialController;
use App\Http\Controllers\Dashboard\PageSettings\PageSocial\UpsertPageSocialLinksController;
use App\Http\Controllers\Page\IndexPageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('page')->name('page.')->middleware(['auth', 'verified', 'has.page'])->group(function(){
    Route::get('/', IndexPageSettingsController::class)->name('index');

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
            Route::put('{item}', [PageLinkItemController::class, 'update'])->name('update');
        });
    });

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('{username}', IndexPageController::class)->name('index');