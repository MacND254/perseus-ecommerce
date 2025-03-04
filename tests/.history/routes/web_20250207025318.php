<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController, BlogController, PostController, ContactController, CareerController,
    ApplicationController, UserDashboardController, CheckoutController, OrderController,
    UserProductController, CartController, PrivacyController
};
use App\Http\Controllers\Admin\{
    AdminController, DashboardController, LoginController, UserController, RoleController,
    CategoryTagController, ProductController, CategoryController, AdminPostController,
    PageController, MediaController, SEOController, ThemeController, PluginController,
    AnalyticsController, BackupController, NotificationController, ProfileController,
    SettingController, AdminCareerController, AdminContactController, AdminMessageController,
    AdminOrderController, SalesController
};

// ======================= PUBLIC ROUTES ======================= //

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/about-us', 'about-us.index')->name('about-us.index');
Route::view('/services', 'services')->name('services');
Route::view('/support', 'support')->name('support');

// Blog Routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [PostController::class, 'show'])->name('blog.show');

// Career Routes
Route::get('/careers', [CareerController::class, 'index'])->name('careers.index');
Route::get('/careers/{id}', [CareerController::class, 'show'])->name('careers.show');
Route::get('/careers/{id}/apply', [CareerController::class, 'apply'])->name('careers.apply');
Route::post('/careers/{id}/apply', [CareerController::class, 'submitApplication'])->name('careers.submitApplication');

// Contact Routes
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.store');

// Products (Shop)
Route::get('/products', [UserProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [UserProductController::class, 'show'])->name('products.show');

// ======================= AUTHENTICATED ROUTES ======================= //

Route::middleware(['auth'])->group(function () {
    // User Dashboard
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // Cart Routes
    Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/remove/{itemId}', [CartController::class, 'removeItem'])->name('cart.remove');
    Route::delete('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
    Route::get('/cart/items', [CartController::class, 'getCartItems'])->name('cart.items');

    // Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

    // Orders (User)
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/{orderId}', [OrderController::class, 'show'])->name('orders.show');
        Route::post('/store', [OrderController::class, 'store'])->name('orders.store');
        Route::patch('/{orderId}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
        Route::get('/history', [OrderController::class, 'orderHistory'])->name('orders.history');
    });
});

// ======================= ADMIN ROUTES ======================= //

Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // User Management
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);

    // Posts & Categories
    Route::resource('posts', AdminPostController::class);
    Route::resource('categories', CategoryTagController::class);
    Route::resource('tags', CategoryController::class);

    // Products
    Route::resource('products', ProductController::class);

    // Pages & Media
    Route::resource('pages', PageController::class)->except(['show']);
    Route::prefix('media')->name('media.')->group(function () {
        Route::get('/library', [MediaController::class, 'index'])->name('library');
        Route::get('/upload', [MediaController::class, 'upload'])->name('upload');
    });

    // SEO & Themes
    Route::prefix('seo')->name('seo.')->group(function () {
        Route::get('settings', [SEOController::class, 'settings'])->name('settings');
        Route::get('metadata', [SEOController::class, 'metadata'])->name('metadata');
        Route::get('sitemap', [SEOController::class, 'sitemap'])->name('sitemap');
    });
    Route::resource('themes', ThemeController::class);
    Route::get('themes/customize', [ThemeController::class, 'customize'])->name('themes.customize');

    // Plugins
    Route::prefix('plugins')->name('plugins.')->group(function () {
        Route::get('/', [PluginController::class, 'index'])->name('index');
        Route::get('/install', [PluginController::class, 'install'])->name('install');
    });

    // Analytics & Backup
    Route::get('analytics', [AnalyticsController::class, 'index'])->name('analytics');
    Route::prefix('backup')->name('backup.')->group(function () {
        Route::get('/', [BackupController::class, 'index'])->name('index');
        Route::get('/create', [BackupController::class, 'create'])->name('create');
        Route::get('/restore', [BackupController::class, 'restore'])->name('restore');
    });

    // Notifications & Profile
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');

    // Settings
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'store'])->name('settings.store');

    // Careers (Admin)
    Route::resource('careers', AdminCareerController::class);
    Route::put('careers/{id}', [AdminCareerController::class, 'update'])->name('careers.update');

    // Applications
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{application}/download', [ApplicationController::class, 'download'])->name('applications.download');

    // Admin Orders
    Route::prefix('orders')->group(function () {
        Route::get('/', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/{orderId}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::patch('/{orderId}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    });

    // Sales Reports
    Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');

    // Contact Management
    Route::resource('contact-us', AdminContactController::class);
    Route::resource('messages', AdminMessageController::class)->except(['create', 'store', 'edit', 'update']);
});

// ======================= STATIC SERVICE PAGES ======================= //
Route::prefix('services')->name('services.')->group(function () {
    Route::view('/managed-it', 'our-services.managed-it-services')->name('managed-it');
    Route::view('/cybersecurity', 'our-services.cybersecurity')->name('cybersecurity');
    Route::view('/cloud-computing', 'our-services.cloud-computing')->name('cloud-computing');
    Route::view('/software-development', 'our-services.software-development')->name('software-development');
    Route::view('/it-consulting', 'our-services.it-consulting')->name('it-consulting');
    Route::view('/smart-home-automation', 'our-services.smart-home-automation')->name('smart-home-automation');
    Route::view('/network-installations', 'our-services.installations')->name('network-installations');
});
