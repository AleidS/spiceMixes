<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MixesController;
use App\Http\Controllers\CuisineController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\SharesController;
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
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Cuisines
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('cuisines', CuisineController::class);
});

// About (no controller)
Route::get('about', function () {
    return Inertia::render('About/Index');
})->name('about');
Route::get('contact', function () {
    return Inertia::render('Contact/Index');
})->name('contact');
Route::get('sources', function () {
    return Inertia::render('Sources/Index');
})->name('sources');

Route::get('uploadTerms', function () {
    return Inertia::render('TermsAndConditions/Upload');
});
Route::get('generalTerms', function () {
    return Inertia::render('TermsAndConditions/General');
});

Route::get('/', [MixesController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('mixes', MixesController::class);
    // Route::get('mixes', [MixesController::class, 'home'])->name('mixes');
    Route::get('mixes/create', [MixesController::class, 'create'], function () {
        return Inertia::render('Mixes/Add');
    })->name('mixes.create');
    Route::post('mixes', [MixesController::class, 'store'])->name('mixes');

    Route::get('mixes/edit/{id}', [MixesController::class, 'edit'])->name('mixes.edit');
    Route::get('mixes/duplicate/{id}', [MixesController::class, 'duplicate'])->name(
        'mixes.duplicate'
    );
    Route::post('mixes/{id}', [MixesController::class, 'update'])->name('mixes.update');
    Route::delete('mixes/delete/{id}', [MixesController::class, 'destroy']);
    Route::post('shares/accept/{id}', [SharesController::class, 'accept'])->name('shares.accept');
    Route::post('shares/decline/{id}', [SharesController::class, 'decline'])->name(
        'shares.decline'
    );
    Route::post('shares/send', [SharesController::class, 'send'])->name('shares.send');
    Route::get('cuisines', [CuisineController::class, 'index'])->name('cuisines');
    Route::put('cuisines/edit/{id}', [CuisineController::class, 'edit'], function () {
        return Inertia::render('Cuisines/Index');
    });
    Route::post('cuisines', [CuisineController::class, 'store']);
    Route::delete('cuisines/delete/{id}', [CuisineController::class, 'destroy'], function () {
        return Inertia::render('Cuisines/Index');
    });
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('/favorite', FavoriteController::class);
    Route::delete('/favorite', [FavoriteController::class, 'destroy']);
});
// Make sure /{id} is after anything else, otherwise, e.g. mixes/create might be interpreted as an id parameter
Route::get('mixes/show/{id}', [MixesController::class, 'show'])->name('mixes.show');

// Route to redirect to Google's OAuth page
Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name(
    'auth.google.redirect'
);
// Route to handle the callback from Google
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name(
    'auth.google.callback'
);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
