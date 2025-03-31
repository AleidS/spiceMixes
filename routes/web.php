<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MixesController;
use App\Http\Controllers\CuisineController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/', function () {
//     return Inertia::render('Mixes/Index');
// })->middleware(['auth', 'verified'])->name('mixes');



Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Cuisines
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('cuisines', CuisineController::class);
});

// About (no controller)
Route::get('about', function () {
        return Inertia::render('About/Index');
    });

Route::get('/', [MixesController::class, 'home'])->name('home');
Route::get('mixes/{id}', [MixesController::class, 'show'])->name('mixes.show');

Route::middleware(['auth', 'verified'])->group(function () {
    // Route::get('/', [MixesController::class, 'index'])->name('mixes');
    Route::resource('mixes', MixesController::class);
    // Route::get('mixes', [MixesController::class, 'home'])->name('mixes');
    Route::get('mixes/create', [MixesController::class, 'create'], function () {
        return Inertia::render('Mixes/Add');
    })->name('mixes.create');
    Route::post('mixes', [MixesController::class, 'store'])->name('mixes');
    Route::get('mixes/edit/{id}', [MixesController::class, 'edit'])->name('mixes.edit');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';