<?php

use App\Livewire\AdCreate;
use App\Livewire\AdIndex;
use App\Livewire\AdShow;
use App\Livewire\CategoryAds;
use App\Livewire\LocationAds;
use App\Livewire\MyApplications;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/ad/create', AdCreate::class)->name('ad.create');
});
    Route::get('/ads', AdIndex::class)->name('ads.index');
    Route::get('/ads/{slug}', AdShow::class)->name('ads.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/applications', MyApplications::class)->name('dashboard.applications');
});

Route::get('/categories/{category}', CategoryAds::class)->name('categories.show');
Route::get('/locations/{location}', LocationAds::class)->name('locations.show');
