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

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterUserController::class, 'create']);
    Route::post('/register', [RegisterUserController::class, 'store']);

    Route::get('/login', [LoginUserController::class, 'create']);
    Route::post('/login', [LoginUserController::class, 'store']);
});


//Auth actions
Route::middleware('auth')->group(function () {
    Route::delete('/logout', [LoginUserController::class, 'destroy']);

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.show');
    Route::get('/profile/{user}', [ProfileController::class, 'showSpeificUser']);
    Route::patch('/profile', [ProfileController::class, 'update']);
    Route::patch('/profile/tags', [ProfileController::class, 'updateTags']);

    // users
    Route::middleware('can:isUser')->group(function () {
        Route::post('/jobs/{job}/apply', [JobController::class, 'apply']);
        Route::get('/companies/request', [CompaniesController::class, 'userRequestToPrepareCompany']);
        Route::post('/companies/request', [CompaniesController::class, 'userRequestToBecomeCompany']);
    });
    Route::get('/companies/{company}', [CompaniesController::class, 'show']);

    // Admin-only
    Route::middleware('can:isAdmin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index']);
        Route::post('/tag/store', [TagController::class, 'store']);
        Route::get('/admin/company-requests', [CompaniesController::class, 'viewCompanyRequests']);
        Route::patch('/admin/company-requests/{companyRequest}/approve', [CompaniesController::class, 'approveCompanyRequest']);
        Route::patch('/admin/company-requests/{companyRequest}/reject', [CompaniesController::class, 'rejectCompanyRequest']);
    });

    //companies
    Route::middleware('can:isCompany')->group(function () {
        Route::get('/job/create', [JobController::class, 'create']);
        Route::post('/job/create', [JobController::class, 'store']);
    });

    //comon actions
    Route::middleware('can:comp-act,job')->group(function () {
        Route::get('/job/applications/{job}', [JobController::class, 'viewJobApplicants']);
        Route::get('/job/{job}/edit', [JobController::class, 'edit']);
        Route::patch('/job/{job}', [JobController::class, 'update']);
        Route::delete('/job/{job}', [JobController::class, 'destroy']);
    });
});
