<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\JobController;
use App\Http\Controllers\CompanyController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Vendor\ApplicationController;
use App\Http\Controllers\JobControllers;
use App\Http\Controllers\Vendor\VendorControllers;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

use App\Http\Controllers\ReviewController;

    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    // other admin routes...



use App\Http\Controllers\Admin\ProfileController as AdminProfileController;

use App\Http\Controllers\Admin\VendorController as AdminVendorController;


Route::get('/', function () {
    return view('home');
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/jobs', [JobControllers::class, 'index'])->name('jobs.all');
// Static job detail page
Route::get('/jobs/{id}', [JobControllers::class, 'show'])->name('job.detail');
Route::post('/jobs/{id}/apply', [JobControllers::class, 'apply'])->name('job.apply');

// Company reviews page

Route::get('/company-search', [CompanyController::class, 'indexI'])->name('company.search');
Route::get('/find-salaries', [JobController::class, 'findSalaries'])
    ->name('find.salaries');

Route::get('/jobs/{id}', [JobController::class, 'show'])
    ->name('job.detail');


Route::get('/employee-review', [JobController::class, 'review'])->name('jobs.review');
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/jobs/search', [JobController::class, 'review'])->name('jobs.search'); // used for filtering


// Login

// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'registerSubmit'])->name('register.submit');

// User dashboard (protected)
// Login page
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Dashboard (protected)
Route::prefix('user')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
    
});

Route::get('/user/job-history', [App\Http\Controllers\DashboardController::class, 'jobHistory'])
    ->name('user.job-history')
    ->middleware('auth');
    Route::middleware(['auth'])->group(function () {
    Route::get('/user/saved-jobs', [DashboardController::class, 'savedJobs'])
        ->name('user.saved-jobs');
});
Route::delete('/job/{id}/unsave', [JobController::class, 'unsave'])
    ->name('job.unsave');
Route::get('/jobs', [JobController::class, 'index'])
    ->name('jobs.index');
// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Vendor Login
use App\Http\Controllers\Vendor\VendorAuthController as VendorAuthController;
use App\Http\Controllers\Vendor\DashboardController as VendorDashboardController;


Route::prefix('vendor')->group(function () {

    Route::get('/login', [VendorAuthController::class, 'showLoginForm'])->name('vendor.login');
    Route::post('/login', [VendorAuthController::class, 'login'])->name('vendor.login.submit');

    Route::get('/register', [VendorAuthController::class, 'showRegisterForm'])->name('vendor.register');
    Route::post('/register', [VendorAuthController::class, 'register'])->name('vendor.register.submit');

    Route::get('/dashboard', [VendorDashboardController::class, 'index'])->name('vendor.dashboard');

    Route::post('/logout', [VendorAuthController::class, 'logout'])->name('vendor.logout');
     Route::get('post-job', [JobController::class, 'postJob'])->name('vendor.jobs.post');
    Route::post('post-job', [JobController::class, 'storeJob'])->name('vendor.jobs.store');

    // View Jobs
    Route::get('view-job', [JobController::class, 'viewJobs'])->name('vendor.jobs.view');

    // Edit & Update Job
    Route::get('jobs/edit/{id}', [JobController::class, 'editJob'])->name('vendor.jobs.edit');
    Route::put('jobs/update/{id}', [JobController::class, 'updateJob'])->name('vendor.jobs.update');

    // Delete Job
    Route::delete('jobs/delete/{id}', [JobController::class, 'destroyJob'])->name('vendor.jobs.destroy');

    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications');
    Route::get('/application-detail', [ApplicationController::class, 'show'])->name('applications');

    
});
use App\Http\Controllers\UserController;


Route::middleware(['auth'])->group(function () {
    Route::get('/user/edit-profile', [UserController::class, 'edit']);
});
Route::middleware(['auth'])->group(function () {
    // Show edit profile form
    Route::get('/user/profile/edit', [UserController::class, 'edit'])
        ->name('profile.edit');  // <-- THIS NAME IS CRUCIAL

    // Handle profile update
    Route::post('/user/profile/update', [UserController::class, 'update'])
        ->name('profile.update');
});
Route::middleware(['auth', 'role:vendor'])->get('/vendor/dashboard', function () {
    return view('vendor.dashboard');
})->name('vendor.dashboard');

Route::middleware(['auth', 'role:user'])->group(function () {
   Route::get('/user/dashboard', [DashboardController::class, 'index'])
    ->name('user.dashboard')
    ->middleware(['auth', 'role:user']);
});

// Vendor profile routes
Route::prefix('vendor')->middleware(['auth', 'role:vendor'])->group(function () {
    Route::get('/profile', [App\Http\Controllers\Vendor\ProfileController::class, 'edit'])->name('vendor.profile.edit');
    Route::post('/profile', [App\Http\Controllers\Vendor\ProfileController::class, 'update'])->name('vendor.profile.update');
});


// Admin route group

use App\Http\Controllers\Admin\JobController as AdminJobController;

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('jobs', [AdminJobController::class, 'index'])->name('jobs.index'); // list only
    Route::get('jobs/create', [AdminJobController::class, 'create'])->name('jobs.create');
    Route::post('jobs', [AdminJobController::class, 'store'])->name('jobs.store');
    Route::get('jobs/{job}/edit', [AdminJobController::class, 'edit'])->name('jobs.edit');
    Route::put('jobs/{job}', [AdminJobController::class, 'update'])->name('jobs.update');
    Route::delete('jobs/{job}', [AdminJobController::class, 'destroy'])->name('jobs.destroy');
    Route::get('jobs/{job}/toggle-status', [AdminJobController::class, 'toggleStatus'])->name('jobs.toggle-status');



    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [AdminProfileController::class, 'update'])->name('profile.update');

    // Users Management

        Route::get('/users', [AdminUserController::class, 'index'])
            ->name('users.index');

        Route::get('/users/block/{id}', [AdminUserController::class, 'block'])
            ->name('users.block');

        Route::get('/users/unblock/{id}', [AdminUserController::class, 'unblock'])
            ->name('users.unblock');
    // Vendors Management
    Route::get('/vendors', [AdminVendorController::class, 'index'])->name('vendors.index');          // list vendors
    Route::get('/vendors/create', [AdminVendorController::class, 'create'])->name('vendors.create'); // show add vendor form
    Route::post('/vendors', [AdminVendorController::class, 'store'])->name('vendors.store');         // store new vendor
    Route::get('/vendors/{id}/edit', [AdminVendorController::class, 'edit'])->name('vendors.edit');  // edit vendor
    Route::put('/vendors/{id}', [AdminVendorController::class, 'update'])->name('vendors.update');   // update vendor
    Route::delete('/vendors/{id}', [AdminVendorController::class, 'destroy'])->name('vendors.destroy'); // delete vendor




    
});

use App\Http\Controllers\Admin\CategoryController;

Route::prefix('admin')->name('admin.')->group(function() {
    // Category management (admin)
    Route::resource('categories', CategoryController::class);
});

Route::get('/company-search', [ReviewController::class, 'index'])->name('company.search');
Route::get('/company-search/results', [CompanyController::class, 'search'])->name('company.search.results');
Route::post('/jobs/{id}/save', [App\Http\Controllers\JobControllers::class, 'save'])->name('jobs.save')->middleware('auth');
Route::post('/vendor/applications/{id}/status', [App\Http\Controllers\Vendor\ApplicationController::class, 'updateStatus'])
    ->name('vendor.applications.status')
    ->middleware('auth:vendor'); // or 'auth' depending on your setup
Route::patch('/vendor/applications/{id}', [App\Http\Controllers\Vendor\ApplicationController::class, 'update'])
    ->name('vendor.application.update');
Route::post('/job/{job}/apply', [JobApplyController::class, 'store'])
    ->middleware(['auth', 'role:user'])
    ->name('job.apply');


    use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Show forget password form
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgetForm'])
    ->name('password.request');

// Submit email to send reset link
Route::post('/forgot-password', [ForgotPasswordController::class, 'submitForgetForm'])
    ->name('password.email');

// Show reset password form
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');

// Submit new password
Route::post('/reset-password', [ResetPasswordController::class, 'submitResetForm'])
    ->name('password.update');


    // Blog details page

use App\Http\Controllers\BlogController;


Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
// Admin blog management
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function() {
    Route::resource('blogs', App\Http\Controllers\Admin\BlogController::class);
    
});

// Blog detail for frontend
Route::get('/blog/{slug}', [App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');

use App\Http\Controllers\Admin\CompanyController as AdminCompanyController;


Route::prefix('admin')->middleware('auth')->group(function () {

       Route::resource('companies', AdminCompanyController::class);

});


Route::get('/company-search', [CompanyController::class, 'search'])->name('company.search');
Route::get('/companies/{id}/jobs', [CompanyController::class, 'jobs'])->name('company.jobs');
// Contact
Route::get('/contact', fn() => view('contact'))->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Admin
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
   Route::get('contact-messages', [ContactController::class, 'index'])
        ->name('contact.messages');

    // Delete a message
    Route::delete('contact-messages/{id}', [ContactController::class, 'destroy'])
        ->name('contact.messages.delete');
});

Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('companies/{id}/jobs', [CompanyController::class, 'jobs'])->name('company.jobs');

