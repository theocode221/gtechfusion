<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\WeddingCardController;
use App\Http\Controllers\Admin\RsvpController;
use App\Http\Controllers\Admin\WishController;
use App\Http\Controllers\CardController;

// ── Public Routes ──
Route::get('/', fn() => view('welcome'));
Route::get('/wedding-card', fn() => view('wedding-card'));
Route::get('/jemputan-frame', fn() => view('jemputan-frame'));
Route::get('/invites/amir-syahira', fn() => view('cards.amir-syahira'));

// ── Dynamic Card Route ──
Route::get('/card/{slug}', [CardController::class, 'show'])->name('card.show');

// ── Public Submit Routes (guests — no auth needed) ──
Route::post('/card/{card}/rsvp', [RsvpController::class, 'store'])->name('cards.rsvp.store');
Route::post('/card/{card}/wish', [WishController::class, 'store'])->name('cards.wish.store');

// ── Admin Routes ──
Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminLoginController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminLoginController::class, 'login'])->name('login.post');
    });

    Route::middleware('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

        Route::resource('cards', WeddingCardController::class);
        Route::patch('cards/{card}/toggle', [WeddingCardController::class, 'toggleStatus'])
            ->name('cards.toggle');

        Route::get('rsvp', [RsvpController::class, 'index'])->name('rsvp.index');
        Route::delete('rsvp/{rsvp}', [RsvpController::class, 'destroy'])->name('rsvp.destroy');

        Route::get('wishes', [WishController::class, 'index'])->name('wishes.index');
        Route::delete('wishes/{wish}', [WishController::class, 'destroy'])->name('wishes.destroy');
    });
});