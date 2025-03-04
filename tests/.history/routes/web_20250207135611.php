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
use App\Http\Livewire\Cart;



// Regular Routes
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Jetstream Dashboard (for regular users)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Admin Authentication Routes
Route::get('/admin/auth/a-login', [LoginController::class, 'showLoginForm'])->name('admin.a-login');
Route::post('/admin/auth/a-login', [LoginController::class, 'login'])->name('admin.a-login.submit');

// Admin Authentication Guard Routes
Route::middleware(['auth:admin'])->group(function () {

    // Admin Dashboard Route
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Admin route for managing admins
    Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
        Route::resource('admins', AdminController::class)->names('admins');
    });

    // Admin Routes Prefix 'admin'
    Route::prefix('admin')->name('admin.')->group(function () {

        // User Management Routes
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class)->names('users');


        // User Logs Route
       // Route::get('/users/logs', [UserLogController::class, 'index'])->name('users.logs');

        // Admin Users Routes
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/logs', [UserController::class, 'logs'])->name('logs');
        });

        // Content Management Routes
        Route::resource('posts', AdminPostController::class)->names('posts');
        Route::resource('categories', CategoryTagController::class)->names('categories');
        //Route::resource('tags', TagController::class)->names('tags');


        //Products Management
        Route::prefix('admin')->middleware('auth:admin')->group(function () {
         Route::resource('products', ProductController::class);
        });

        //Products Category
        Route::resource('categories', CategoryController::class);


        // Pages Routes
        Route::resource('pages', PageController::class)->except(['show'])->names('pages');
        Route::get('/admin/categories-tags', [CategoryTagController::class, 'index'])->name('categories.tags');

        /*/ Media Management Routes
Route::prefix('media')->name('media.')->group(function () {
    // Route for listing media items (library)
    Route::get('/library', [MediaController::class, 'index'])->name('library');
    // Other media management routes like upload, etc.
    Route::get('/upload', [MediaController::class, 'upload'])->name('upload');
});

        // SEO Management Routes
        Route::get('seo/settings', [SEOController::class, 'settings'])->name('seo.settings');
        Route::get('seo/metadata', [SEOController::class, 'metadata'])->name('seo.metadata');
        Route::get('seo/sitemap', [SEOController::class, 'sitemap'])->name('seo.sitemap');

        // Themes Management Routes
        Route::resource('themes', ThemeController::class)->names('themes');
        Route::get('themes/customize', [ThemeController::class, 'customize'])->name('themes.customize');

       */ // Plugins Routes
Route::prefix('plugins')->name('plugins.')->group(function () {
    // Route for listing installed plugins
   // Route::get('/', [PluginController::class, 'index'])->name('index');

    // Route for installing a plugin
    //Route::get('/install', [PluginController::class, 'install'])->name('install');
});


        // Analytics Route
        Route::get('analytics', [AnalyticsController::class, 'index'])->name('analytics.index');
        // Analytics Route
    Route::get('analytics', [AnalyticsController::class, 'index'])->name('analytics');


        // Backup & Restore Routes
       // Route::get('backup', [BackupController::class, 'index'])->name('backup.index');
       // Route::get('backup/create', [BackupController::class, 'create'])->name('backup.create');
        //Route::get('backup/restore', [BackupController::class, 'restore'])->name('backup.restore');

        // Notifications & Profile Routes
        Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
        Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');

        // Settings Route
      //  Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
      //  Route::post('settings', [SettingController::class, 'store'])->name('settings.store');

        // Define the 'terms' route
        Route::get('/terms', function () {
         return view('terms');  // This will return the 'terms' view
        })->name('terms');
/*
        // Define the 'privacy' route
        Route::get('/p-privacy', function () {
         return view('p-privacy');  // This will return the 'privacy' view
        })->name('p-privacy');

        // Using the controller for the 'privacy' route
        Route::get('views/p-privacy', [PrivacyController::class, 'index'])->name('p-privacy');
*/


    });
});

Route::get('/blog', [PostController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [PostController::class, 'show'])->name('blog.show');

Route::prefix('admin')->group(function () {
    Route::get('/posts', [PostController::class, 'adminIndex'])->name('admin.posts.index'); // List posts
    Route::get('/posts/create', [PostController::class, 'create'])->name('admin.posts.create'); // Create form
    Route::post('/posts', [PostController::class, 'store'])->name('admin.posts.store'); // Store new post
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('admin.posts.edit'); // Edit form
    //Route::put('/posts/{post}', [PostController::class, 'update'])->name('admin.posts.update'); // Update post
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('admin.posts.destroy'); // Delete post
});
/*
Route::get('/', function () {
    return view('welcome'); // Replace 'welcome' with your home page view if different.
})->name('home');
*/
Route::get('/about-us.index', function () {
    return view('about-us.index'); // Replace 'about' with the actual view.
})->name('about-us.index');

Route::get('/services', function () {
    return view('services'); // Replace 'services' with the actual view.
})->name('services');

Route::get('/career', function () {
    return view('career'); // Replace 'career' with the actual view.
})->name('career');

Route::get('/blog', function () {
    return view('blog.index'); // Replace 'products' with the actual view.
})->name('blog');

Route::get('/products', function () {
    return view('products'); // Replace 'products' with the actual view.
})->name('products');

Route::get('/support', function () {
    return view('support'); // Replace 'support' with the actual view.
})->name('support');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
/*
Route::get('/blog', function () {
    return view('blog.index'); // Replace 'blog' with the actual view.
})->name('blog.index');
*/

//pages
Route::resource('pages', PageController::class);
Route::get('admin/pages', [PageController::class, 'index'])->name('pages.index');
Route::get('admin/pages', [PageController::class, 'index'])->name('admin.pages.index');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

});



// Admin career Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('careers', AdminCareerController::class);
    Route::put('/admin/careers/{id}', [AdminCareerController::class, 'update'])->name('admin.careers.update');

});
//Route::put('/admin/careers/{id}', [AdminCareerController::class, 'update'])->name('admin.careers.update');
// Public routes for careers
// Public Career Routes
Route::get('/careers', [CareerController::class, 'index'])->name('careers.index'); // List of careers
Route::get('/careers/{id}', [CareerController::class, 'show'])->name('career.show'); // Show a single career position

//
Route::get('career/{id}', [CareerController::class, 'show'])->name('career.show');
Route::get('/careers/{id}/apply', [CareerController::class, 'apply'])->name('career.apply');
Route::post('/careers/{id}/apply', [CareerController::class, 'submitApplication'])->name('career.submitApplication');
Route::get('/careers', [CareerController::class, 'index'])->name('career.index');
Route::get('/careers/{id}', [CareerController::class, 'show'])->name('careers.show');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{application}/download', [ApplicationController::class, 'download'])->name('applications.download');
    //Route::get('admin/applications/{application}/download', [ApplicationController::class, 'download'])->name('applications.download');

    //contacts-admin
    Route::get('/contact-us', [AdminContactController::class, 'index'])->name('contact-us.index');
    Route::get('/contact-us/create', [AdminContactController::class, 'create'])->name('contact-us.create');
    Route::post('/contact-us', [AdminContactController::class, 'store'])->name('contact-us.store');
    Route::get('/contact-us/{contact}/edit', [AdminContactController::class, 'edit'])->name('contact-us.edit');
    Route::put('/contact-us/{contact}', [AdminContactController::class, 'update'])->name('contact-us.update');
    Route::delete('/contact-us/{contact}', [AdminContactController::class, 'destroy'])->name('contact-us.destroy');

    //messages
    Route::resource('messages', AdminMessageController::class)->except(['create', 'store', 'edit', 'update']);


});

//contacts
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact-us.index');
Route::post('/contact-us', [ContactController::class, 'store'])->name('contact-us.store');

//our-services


// Static Routes for Our Services
Route::view('/services/managed-it', 'our-services.managed-it-services')->name('services.managed-it');
Route::view('/services/cybersecurity', 'our-services.cybersecurity')->name('services.cybersecurity');
Route::view('/services/cloud-computing', 'our-services.cloud-computing')->name('services.cloud-computing');
Route::view('/services/software-development', 'our-services.software-development')->name('services.software-development');
Route::view('/services/it-consulting', 'our-services.it-consulting')->name('services.it-consulting');
Route::view('/services/smart-home-automation', 'our-services.smart-home-automation')->name('services.smart-home-automation');
Route::view('/services/network-installations', 'our-services.installations')->name('services.network-installations');







/*
//career public

Route::get('/career', [CareerController::class, 'index'])->name('career.index');
Route::get('/career/{id}', [CareerController::class, 'show'])->name('career.show');
Route::get('/career/{id}/apply', [CareerController::class, 'apply'])->name('career.apply');



Route::get('/career/{id}/apply', [ApplicationController::class, 'create'])->name('career.apply');
Route::post('/career/{id}/apply', [ApplicationController::class, 'store'])->name('career.apply.store');

//careers admin



Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('careers', CareerController::class);
});

Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {
    Route::resource('careers', AdminCareerController::class);
});
*/

//user order controller

Route::prefix('orders')->middleware('auth')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/{orderId}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/store', [OrderController::class, 'store'])->name('orders.store');
    Route::patch('/{orderId}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::get('/history', [OrderController::class, 'orderHistory'])->name('orders.history');
});

//admin order controller

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // List all orders
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');

    // View order details
    Route::get('/orders/{orderId}', [AdminOrderController::class, 'show'])->name('admin.orders.show');

    // Update order status
    Route::patch('/orders/{orderId}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
});


//sales

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // Sales report overview
    Route::get('/sales', [SalesController::class, 'index'])->name('admin.sales.index');
});

//products homepage route

/*
use App\Models\Product;

Route::get('/', function () {
    $products = Product::latest()->take(8)->get(); // Fetch latest products
    return view('home', compact('products'));
});
*/


// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');

/*
//products listing

Route::get('/products', function () {
    // Fetch products with pagination
    $products = Product::paginate(10); // Fetch 10 products per page

    return view('products.index', compact('products'));
});
//product's details

Route::get('/product/{id}', function ($id) {
    $product = Product::with('reviews')->findOrFail($id); // Assuming you have a relationship defined for reviews
    return view('product.details', compact('product'));
})->name('product.details');
*/

Route::get('/products', [UserProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [UserProductController::class, 'show'])->name('products.show');

/*
//cart
use App\Models\CartItem;

Route::get('/cart', function () {
    $cartItems = CartItem::with('product')->where('user_id', auth()->id())->get();
    $cartTotal = $cartItems->sum(function ($item) {
        return $item->product->price * $item->quantity;
    });

    return view('cart.index', compact('cartItems', 'cartTotal'));
})->name('cart.index');

 /checkout

Route::get('/checkout', function () {
    $cartItems = CartItem::with('product')->where('user_id', auth()->id())->get();
    $cartTotal = $cartItems->sum(function ($item) {
        return $item->product->price * $item->quantity;
    });

    return view('checkout.index', compact('cartItems', 'cartTotal'));
})->name('checkout.index');

//Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

// Show the checkout page
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

// Process the checkout form
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
*/

// User Dashboard
Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
Route::get('/user/edit', [UserController::class, 'edit'])->name('user.edit');

// Product details route
Route::get('/products/{id}', [UserProductController::class, 'show'])->name('products.show');

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

/* // Cart Routes
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/remove/{key}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/cart/getData', [CartController::class, 'getCartData'])->name('cart.getData');




Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
//Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
//Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
*/

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/cart/update-quantity/{key}', [CartController::class, 'updateQuantity'])->name('cart.update.quantity');
Route::get('/cart/getData', [CartController::class, 'getCartData'])->name('cart.getData');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
