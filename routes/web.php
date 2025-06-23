<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HostListingController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HostDashboardController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/search', [HomeController::class, 'search'])->name('search');

Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::get('/search-by-listing', [HomeController::class, 'searchByListing'])->name('search.byListing');

Route::get('/listing/{id}', [ListingController::class, 'show'])->name('listing.show');

Route::get('/contact', function () {
    return view('contact');
})->name('contact.page');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login')->middleware(\App\Http\Middleware\UpdateBookingStatus::class);  // Login page
Route::post('login', [LoginController::class, 'login'])->middleware(\App\Http\Middleware\UpdateBookingStatus::class);  // Handle login form submission
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/host/dashboard', [HostDashboardController::class, 'index'])->name('host.dashboard');



Route::middleware(['auth'])->group(function () {
    Route::get('/host/dashboard', [HostDashboardController::class, 'index'])->name('host.dashboard');
});

Route::middleware(['auth'])->prefix('host/listings')->name('host.listings.')->group(function () {
    Route::get('/', [HostListingController::class, 'index'])->name('index');
    Route::get('/create', [HostListingController::class, 'create'])->name('create');
    Route::post('/', [HostListingController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [HostListingController::class, 'edit'])->name('edit');
    Route::put('/{id}', [HostListingController::class, 'update'])->name('update');
    Route::delete('/{id}', [HostListingController::class, 'destroy'])->name('destroy');
    Route::post('/host/listings', [HostListingController::class, 'store'])->name('host.listings.store');
    Route::get('listings/create', [HostListingController::class, 'create'])->name('listings.create');
    Route::post('listings', [HostListingController::class, 'store'])->name('listings.store');
    Route::get('/dashboard', [HostDashboardController::class, 'index'])->name('dashboard');


    Route::get('/host/listings/{id}/edit', [HostListingController::class, 'edit'])->name('host.listings.edit');
Route::put('/host/listings/{id}', [HostListingController::class, 'update'])->name('host.listings.update');


});

Route::middleware(['auth'])->group(function () {
    // Photo delete route without prefix conflict
    Route::delete('/host/photos/{photo}', [HostListingController::class, 'deletePhoto'])->name('host.photos.delete');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::post('/bookings/{id}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
    Route::get('/checkout', [BookingController::class, 'showCheckout'])->name('checkout');
    Route::post('/book', [BookingController::class, 'store'])->name('book');
    Route::post('/booking/{id}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');

});


Route::get('/user-info', function () {
    return response()->json([
        'name' => Auth::user()->name,
        'email' => Auth::user()->email,
        'contact_no' => Auth::user()->contact_no,
    ]);
})->middleware('auth');


Route::middleware(['auth'])->group(function () {
    // Guest bookings page
    Route::get('/bookings/guest', [BookingController::class, 'guestBookings'])->name('bookings.guest')->middleware(\App\Http\Middleware\UpdateBookingStatus::class);

    // Booking details page
    Route::get('/guest/booking/{id}', [BookingController::class, 'showGuestBookingDetail'])->name('booking.detail')->middleware(\App\Http\Middleware\UpdateBookingStatus::class);
 
    // Print details
    Route::get('/booking/print/{id}', [BookingController::class, 'print'])->name('booking.print');

    // Host bookings page
    Route::get('/host/listing/{listing}', [BookingController::class, 'showListingBookings'])->name('host.listing.bookings')->middleware(\App\Http\Middleware\UpdateBookingStatus::class);

    // to toggle active
    Route::post('/host/listings/{id}/toggle-state', [HostListingController::class, 'toggleState'])->name('host.listings.toggleState');

});

