<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BroadcastController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FollowUpController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PipelineController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WhatsAppWebhookController;
use App\Http\Controllers\WhatsAppStatusController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/sitemap.xml', function () {
    return response()->view('sitemap')->header('Content-Type', 'application/xml');
})->name('sitemap');

// WhatsApp Cloud API webhook (no auth, uses verify token from settings)
Route::get('whatsapp/webhook', [WhatsAppWebhookController::class, 'verify']);
Route::post('whatsapp/webhook', [WhatsAppWebhookController::class, 'handle']);

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth', 'trial.access'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('leads', [LeadController::class, 'index'])->name('leads.index');
    Route::get('leads/create', [LeadController::class, 'create'])->name('leads.create');
    Route::post('leads', [LeadController::class, 'store'])->name('leads.store');
    Route::get('leads/{lead}', [LeadController::class, 'show'])->name('leads.show');
    Route::get('leads/{lead}/edit', [LeadController::class, 'edit'])->name('leads.edit');
    Route::put('leads/{lead}', [LeadController::class, 'update'])->name('leads.update');

    Route::get('pipeline', [PipelineController::class, 'index'])->name('pipeline.index');

    Route::get('follow-ups', [FollowUpController::class, 'index'])->name('follow-ups.index');
    Route::get('follow-ups/create', [FollowUpController::class, 'create'])->name('follow-ups.create');
    Route::post('follow-ups', [FollowUpController::class, 'store'])->name('follow-ups.store');
    Route::put('follow-ups/{followUp}/status', [FollowUpController::class, 'updateStatus'])->name('follow-ups.update-status');

    Route::get('broadcasts', [BroadcastController::class, 'index'])->name('broadcasts.index');
    Route::get('broadcasts/create', [BroadcastController::class, 'create'])->name('broadcasts.create');
    Route::post('broadcasts', [BroadcastController::class, 'store'])->name('broadcasts.store');
    Route::get('broadcasts/{broadcast}', [BroadcastController::class, 'show'])->name('broadcasts.show');

    Route::get('subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');

    // Organization: read-only WhatsApp status (no credentials)
    Route::get('whatsapp-status', [WhatsAppStatusController::class, 'index'])
        ->name('whatsapp-status.index')
        ->middleware('role:organization');

    Route::middleware('super_admin')->group(function () {
        Route::resource('organizations', OrganizationController::class);
        Route::resource('plans', PlanController::class)->except(['show', 'destroy']);
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
        Route::post('settings/test-whatsapp', [SettingController::class, 'testWhatsApp'])->name('settings.test-whatsapp');
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('users', [UserController::class, 'store'])->name('users.store');
        Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
        Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');
    });
});
