<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\CategoryTagController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\PluginController;
use App\Http\Controllers\Admin\SEOController;
use App\Http\Controllers\Admin\UserLogController;
use App\Http\Controllers\Admin\ThemeController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AdminCareerController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminMessageController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Models\Product;
use App\Http\Controllers\UserProductController;
use App\Http\Controllers\CartController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', function () {
    return view('about-us.index');
})->name('about-us.index');
Route::get('/services', function () {
    return view('services');
})->name('services');
Route::get('/careers', [CareerController::class, 'index'])->name('careers.index');
Route::get('/careers/{id}', [CareerController::class, 'show'])->name('careers.show');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [PostController::class, 'show'])->name('blog.show');
Route::get('/products', [UserProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [UserProductController::class, 'show'])->name('products.show');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Static Service Routes
Route::view('/services/managed-it', 'our-services.managed-it-services')->name('services.managed-it');
Route::view('/services/cybersecurity', 'our-services.cybersecurity')->name('services.cybersecurity');
Route::view('/services/cloud-computing', 'our-services.cloud-computing')->name('services.cloud-computing');
Route::view('/services/software-development', 'our-services.software-development')->name('services.software-development');
Route::view('/services/it-consulting', 'our-services.it-consulting')->name('services.it-consulting');
Route::view('/services/smart-home-automation', 'our-services.smart-home-automation')->name('services.smart-home-automation');
Route::view('/services/network-installations', 'our-services.installations')->name('services.network-installations');

// User Authentication Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    // Cart Routes
    Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/remove/{itemId}', [CartController::class, 'removeItem'])->name('cart.remove');
    Route::delete('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
    Route::get('/cart/items', [CartController::class, 'getCartItems'])->name('cart.items');

    // Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

    // User Dashboard
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/user/edit', [UserController::class, 'edit'])->name('user.edit');

    // Orders
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/{orderId}', [OrderController::class, 'show'])->name('orders.show');
        Route::post('/store', [OrderController::class, 'store'])->name('orders.store');
        Route::patch('/{orderId}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
        Route::get('/history', [OrderController::class, 'orderHistory'])->name('orders.history');
    });
});

// Admin Authentication Routes
Route::get('/admin/auth/a-login', [LoginController::class, 'showLoginForm'])->name('admin.a-login');
Route::post('/admin/auth/a-login', [LoginController::class, 'login'])->name('admin.a-login.submit');



// ================================================================================================================================ //

Route::prefix('admin')->name('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Admin Management
    Route::resource('admins', AdminController::class);

    // Page Management
    Route::resource('pages', PageController::class)->except(['show']);

    // Categories and Tags Management
    Route::get('/categories_tags', [CategoryTagController::class, 'index'])->name('categories_tags');

    // Contact Us Management
    Route::resource('contact-us', AdminContactController::class);

    // Analytics Route
    Route::get('analytics', [AnalyticsController::class, 'index'])->name('analytics.index');

    // Add more admin routes here as needed...
});

// ================================================================================================================================ //

// Admin Routes (Protected by Admin Middleware)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // User Management
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::get('/users/logs', [UserLogController::class, 'index'])->name('users.logs');

    // Content Management
    Route::resource('posts', AdminPostController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);

    // Product Management
    Route::resource('products', ProductController::class);

    // Media Management
    Route::prefix('media')->name('media.')->group(function () {
        Route::get('/library', [MediaController::class, 'index'])->name('library');
        Route::get('/upload', [MediaController::class, 'upload'])->name('upload');
    });

    // SEO Management
    Route::get('seo/settings', [SEOController::class, 'settings'])->name('seo.settings');
    Route::get('seo/metadata', [SEOController::class, 'metadata'])->name('seo.metadata');
    Route::get('seo/sitemap', [SEOController::class, 'sitemap'])->name('seo.sitemap');

    // Themes Management
    Route::resource('themes', ThemeController::class);
    Route::get('themes/customize', [ThemeController::class, 'customize'])->name('themes.customize');

    // Plugins Management
    Route::prefix('plugins')->name('plugins.')->group(function () {
        Route::get('/', [PluginController::class, 'index'])->name('index');
        Route::get('/install', [PluginController::class, 'install'])->name('install');
    });

    // Analytics
    Route::get('analytics', [AnalyticsController::class, 'index'])->name('analytics.index');

    // Backup & Restore
    Route::get('backup', [BackupController::class, 'index'])->name('backup.index');
    Route::get('backup/create', [BackupController::class, 'create'])->name('backup.create');
    Route::get('backup/restore', [BackupController::class, 'restore'])->name('backup.restore');

    // Notifications & Profile
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');

    // Settings
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'store'])->name('settings.store');

    // Terms & Privacy
    Route::get('/terms', function () {
        return view('terms');
    })->name('terms');
    Route::get('/p-privacy', [PrivacyController::class, 'index'])->name('p-privacy');

    // Careers (Admin)
    Route::resource('careers', AdminCareerController::class);
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{application}/download', [ApplicationController::class, 'download'])->name('applications.download');

    // Contacts (Admin)
    Route::resource('contacts', AdminContactController::class);
    Route::resource('messages', AdminMessageController::class);

    // Orders (Admin)
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{orderId}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{orderId}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // Sales (Admin)
    Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');
});

Route::get('/careers', [CareerController::class, 'index'])->name('career.index');
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact-us.index');

// Commented Routes (Moved to Bottom)
/*
// Duplicated Routes
Route::get('/blog', function () {
    return view('blog.index');
})->name('blog.index');

Route::get('/career', function () {
    return view('career');
})->name('career');

Route::get('/products', function () {
    return view('products');
})->name('products');

Route::get('/support', function () {
    return view('support');
})->name('support');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');

Route::get('/career/{id}', [CareerController::class, 'show'])->name('career.show');
Route::get('/careers/{id}/apply', [CareerController::class, 'apply'])->name('career.apply');
Route::post('/careers/{id}/apply', [CareerController::class, 'submitApplication'])->name('career.submitApplication');
Route::get('/careers', [CareerController::class, 'index'])->name('career.index');
Route::get('/careers/{id}', [CareerController::class, 'show'])->name('careers.show');

Route::get('/contact-us', [ContactController::class, 'index'])->name('contact-us.index');
Route::post('/contact-us', [ContactController::class, 'store'])->name('contact-us.store');
*/
