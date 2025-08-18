<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    CompaniesController,
    JobController,
    RegisterUserController,
    LoginUserController,
    SearchController,
    AdminController,
    ProfileController,
    TagController,
    HomeController
};

Route::get('/', [HomeController::class, 'index']);

Route::controller(SearchController::class)->group(function () {
    Route::post('/search', 'get');
    Route::post('/jobs/search', 'getJobs');
    Route::post('/companies/search', 'getCompanies');
});

Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/{job}', [JobController::class, 'show']);

Route::get('/companies', [CompaniesController::class, 'index']);
Route::get('/companies/{company}', [CompaniesController::class, 'show']);

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterUserController::class, 'create']);
    Route::post('/register', [RegisterUserController::class, 'store']);

    Route::get('/login', [LoginUserController::class, 'create']);
    Route::post('/login', [LoginUserController::class, 'store']);
});


//Auth actions
Route::middleware('auth')->group(function () {
    Route::delete('/logout', [LoginUserController::class, 'destroy']);
    Route::get('/profile', [ProfileController::class, 'index']);

    Route::post('/jobs/{job}/apply', [JobController::class, 'apply'])
        ->middleware('can:can-apply');

    // Admin-only
    Route::middleware('can:access-admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index']);
        Route::post('/tag/store', [TagController::class, 'store']);
    });
});
