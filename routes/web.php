<?php

use App\Http\Controllers\CompaniesController;
use Illuminate\Support\Facades\Route;
use App\Models\Job;
use App\Models\Tag;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    $featuredJobs = Job::with('employer:id,name', 'tags:id,title')
        ->where('featured', true)
        ->take(6)
        ->get();

    $allJobs = Job::with(['employer:id,name', 'tags:id,title'])
        ->inRandomOrder()
        ->take(6)
        ->get();

    $tags = Tag::take(20)->get();

    return view('home', [
        'featuredJobs' => $featuredJobs,
        'allJobs' => $allJobs,
        'tags' => $tags
    ]);
});


Route::post('/search', [SearchController::class, 'get']);
Route::post('/jobs/search', [SearchController::class, 'getJobs']);
Route::post('/companies/search', [SearchController::class, 'getCompanies']);

Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/{job}', [JobController::class, 'show']);
Route::post('/jobs/{job}/apply', [JobController::class, 'apply'])->middleware('auth', "can:can-apply");

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterUserController::class, 'create']);
    Route::post('/register', [RegisterUserController::class, 'store']);

    Route::get('/login', [LoginUserController::class, 'create']);
    Route::post('/login', [LoginUserController::class, 'store']);
});
Route::delete('/logout', [LoginUserController::class, 'destroy'])->middleware('auth');

Route::get('/companies', [CompaniesController::class, 'index']);
Route::get('/companies/{company}', [CompaniesController::class, 'show']);


Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth');
Route::get('/admin', [AdminController::class, 'index'])->middleware('auth', 'can:access-admin');
