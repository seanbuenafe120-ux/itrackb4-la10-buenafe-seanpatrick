<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/whoami', function () {
    return 'Sean Patrick T. Buenafe | 2023-70372 | Block 4C | ITRACKB4 Laravel 12';
});

Route::get('/movies/featured', [MovieController::class, 'featured'])
    ->name('movies.featured');

Route::get('/movies/filter/{genre?}', function ($genre = null) {
    if ($genre) {
        return redirect()->route('movies.index', ['genre' => $genre]);
    }
    return redirect()->route('movies.index');
});

Route::resource('movies', MovieController::class);