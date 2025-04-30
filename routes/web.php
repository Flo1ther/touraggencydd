<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\PublicTourController;
use App\Http\Controllers\TourImageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PublicPostController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;


// Публічна частина
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('tour')->group(function () {
    Route::get('/', [PublicTourController::class, 'index'])->name('index');
    Route::get('/{tour}', [PublicTourController::class, 'show'])->name('show');
});

// Профіль користувача
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/tours/{tour}/reviews', [ReviewController::class, 'store'])->name('tours.reviews.store');




// Пости для публічної частини
Route::get('/posts', [PublicPostController::class, 'index'])->name('public.posts.index');
Route::get('/blog/{slug}', [PublicPostController::class, 'show'])->name('public.posts.show');

Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');

Route::get('/bookings/my', [BookingController::class, 'myBookings'])->middleware('auth')->name('bookings.my');
Route::post('/tours/{tour}/book', [BookingController::class, 'store'])->name('bookings.store');

// Адмін-панель
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::resource('tours', TourController::class);
    Route::resource('tour-images', TourImageController::class);
    Route::resource('posts', PostController::class);
    Route::resource('contacts', ContactController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('users', UserController::class);

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::delete('/tour-images/{image}', [TourImageController::class, 'destroy'])->name('tour-images.destroy');



});
Route::delete('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])
    ->middleware('auth')
    ->name('bookings.cancel');



require __DIR__.'/auth.php';
