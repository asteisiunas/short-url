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
