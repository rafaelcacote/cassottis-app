<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\BlogPostController as AdminBlogPostController;
use App\Http\Controllers\Admin\ContactMessageController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('/sobre', 'pages.about')->name('about');
Route::view('/servicos', 'pages.services')->name('services');

// Portfolio
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');
Route::get('/portfolio/{project}', [PortfolioController::class, 'show'])->name('portfolio.show');

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{post}', [BlogController::class, 'show'])->name('blog.show');

Route::view('/contato', 'pages.contact')->name('contact');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Autenticação
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Área administrativa (com autenticação)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard.alt');

    // Projetos
    Route::resource('projects', AdminProjectController::class);

    // Posts do Blog
    Route::resource('blog', AdminBlogPostController::class);
    
    // Mensagens de Contato
    Route::resource('contact-messages', ContactMessageController::class);
    Route::post('contact-messages/{contactMessage}/mark-as-read', [ContactMessageController::class, 'markAsRead'])->name('contact-messages.mark-as-read');
    Route::post('contact-messages/{contactMessage}/mark-as-replied', [ContactMessageController::class, 'markAsReplied'])->name('contact-messages.mark-as-replied');
    Route::post('contact-messages/{contactMessage}/archive', [ContactMessageController::class, 'archive'])->name('contact-messages.archive');
});
