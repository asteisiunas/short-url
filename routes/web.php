<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;
use App\Models\UrlMap;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/short-urls', function (){
    return view('create_url_form');
})->name('short-urls.create');

Route::get('/short-urls/{urlMap}', function(UrlMap $urlMap) {
    return view('show_url', [
        'urlMap' => $urlMap
    ]);
})->name('short-urls.show');

Route::post('/short-urls', [UrlController::class, 'store'])->name('short-urls.store');

Route::get('/short/{hash}', function(string $hash) {
    $urlMap = UrlMap::where('short_url', $hash)->first();

    if ($urlMap === null || $urlMap->url === null) {
        abort(404);
    }

    // TODO: good place for usage analytics

    return redirect()->away($urlMap->url);
})->name('short-urls.redirect');
