<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Halaman publik
|--------------------------------------------------------------------------
*/
Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/projects/{project:slug}', [PageController::class, 'showProject'])->name('projects.show');
Route::get('/blog', [PageController::class, 'blog'])->name('blog.index');
Route::get('/blog/{post:slug}', [PageController::class, 'showPost'])->name('blog.show');
Route::get('/cv', [PageController::class, 'cv'])->name('cv');

Route::post('/contact', [MessageController::class, 'store'])->name('contact.store');
Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');

/*
|--------------------------------------------------------------------------
| Autentikasi
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Dashboard admin
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('projects', Admin\ProjectController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('certificates', Admin\CertificateController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('skills', Admin\SkillController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('educations', Admin\EducationController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('experiences', Admin\ExperienceController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('testimonials', Admin\TestimonialController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('posts', Admin\PostController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::get('messages', [Admin\MessageController::class, 'index'])->name('messages.index');
    Route::patch('messages/{message}/read', [Admin\MessageController::class, 'markRead'])->name('messages.read');
    Route::post('messages/read-all', [Admin\MessageController::class, 'markAllRead'])->name('messages.read-all');
    Route::delete('messages/{message}', [Admin\MessageController::class, 'destroy'])->name('messages.destroy');

    Route::get('profile', [Admin\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [Admin\ProfileController::class, 'update'])->name('profile.update');
});
