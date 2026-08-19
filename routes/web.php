<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;

use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\HomepageController;
use App\Http\Controllers\Admin\ConcessionChargeController;
use App\Http\Controllers\Admin\NavigationController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\DriverApplicationController;
use App\Http\Controllers\Admin\DriverApplicationController as AdminDriverApplicationController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/


Route::get('/clear-all', function () {
    Artisan::call('optimize:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('event:clear');

    return redirect('/admin/dashboard')->with('success', 'All caches cleared successfully!');
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about-us', [PageController::class, 'aboutShow'])->name('about');
Route::get('/about', fn() => redirect()->route('about'));

Route::view('/contact-us', 'contact')->name('contact');
Route::get('/contact', fn() => redirect()->route('contact'));
Route::post('/contact-us', [ContactMessageController::class, 'store'])->name('contact.store');

Route::view('/privacy-policy', 'privacy-policy')->name('privacy');

Route::view('/terms-and-conditions', 'terms-condition')->name('terms');

Route::get('/faqs', [FaqController::class, 'index'])->name('faqs');
Route::get('/faq', fn() => redirect()->route('faqs'));

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::get('/drive-with-us', [DriverApplicationController::class, 'show'])->name('drive-with-us.show');
Route::post('/drive-with-us', [DriverApplicationController::class, 'store'])->name('drive-with-us.store');

Route::view('/book', 'book')->name('book');

Route::get('/test', function () {
    return view('admin.pages.inner.about');
});

/*
|--------------------------------------------------------------------------
| Search
|--------------------------------------------------------------------------
*/

Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/search/ajax', [SearchController::class, 'searchAjax'])->name('search.ajax');
Route::match(['get', 'post'], '/find-address', [SearchController::class, 'findAddress'])->name('find.address');
Route::get('/search/{slug}', [SearchController::class, 'index'])->name('search.slug');

/*
|--------------------------------------------------------------------------
| Blog
|--------------------------------------------------------------------------
*/

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

/*
|--------------------------------------------------------------------------
| Checkout
|--------------------------------------------------------------------------
*/

Route::post('/checkout/create', [CheckoutController::class, 'create'])->name('checkout.create');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/thank-you/{order}', [CheckoutController::class, 'showSuccess'])->name('checkout.success.view');

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('cars', CarController::class);
        Route::get('/cars/{car}/pricing', [CarController::class, 'editPricing'])->name('cars.edit.pricing');

        Route::get('/orders/ajax-list', [OrderController::class, 'ajaxList'])->name('orders.ajax-list');
        Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
        Route::resource('orders', OrderController::class);

        Route::post('/concession-charges', [ConcessionChargeController::class, 'store'])->name('concession-charges.store');
        Route::delete('/concession-charges/{charge}', [ConcessionChargeController::class, 'destroy'])->name('concession-charges.destroy');

        Route::resource('blogs', AdminBlogController::class);

        Route::patch('/faqs/{faq}/toggle-status', [AdminFaqController::class, 'toggleStatus'])->name('faqs.toggle-status');
        Route::resource('faqs', AdminFaqController::class);

        Route::get('/contact-messages', [ContactMessageController::class, 'index'])->name('contact-messages.index');
        Route::delete('/contact-messages/{contactMessage}', [ContactMessageController::class, 'destroy'])->name('contact-messages.destroy');

        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings/update', [SettingController::class, 'update'])->name('settings.update');

        Route::get('/homepage', [HomepageController::class, 'index'])->name('homepage.index');
        Route::post('/homepage', [HomepageController::class, 'store'])->name('homepage.store');
        Route::put('/homepage', [HomepageController::class, 'update'])->name('homepage.update');

        Route::get('/pages/about-us', [AdminPageController::class, 'aboutShow'])->name('pages.about.show');
        Route::put('/pages/about', [AdminPageController::class, 'aboutStore'])->name('pages.about.store');

        Route::get('/pages', [AdminPageController::class, 'index'])->name('pages.index');
        Route::get('/pages/create', [AdminPageController::class, 'create'])->name('pages.create');
        Route::post('/pages', [AdminPageController::class, 'store'])->name('pages.store');
        Route::post('/pages/duplicate', [AdminPageController::class, 'duplicate'])->name('pages.duplicate');
        Route::get('/pages/{id}/edit', [AdminPageController::class, 'edit'])->name('pages.edit');
        Route::put('/pages', [AdminPageController::class, 'update'])->name('pages.update');
        Route::delete('/pages/{id}', [AdminPageController::class, 'destroy'])->name('pages.destroy');

        Route::get('/navigation', [NavigationController::class, 'index'])->name('navigation.index');
        Route::post('/navigation', [NavigationController::class, 'store'])->name('navigation.store');
        Route::put('/navigation/{navigation}', [NavigationController::class, 'update'])->name('navigation.update');
        Route::delete('/navigation/{navigation}', [NavigationController::class, 'destroy'])->name('navigation.destroy');
        Route::post('/navigation/{navigation}/move/{direction}', [NavigationController::class, 'move'])->name('navigation.move');
        Route::post('/navigation/{navigation}/parent', [NavigationController::class, 'updateParent'])->name('navigation.parent');

        Route::get('/driver-applications', [AdminDriverApplicationController::class, 'index'])->name('driver-applications.index');
        Route::post('/driver-applications/{driverApplication}/status', [AdminDriverApplicationController::class, 'updateStatus'])->name('driver-applications.update-status');
        Route::delete('/driver-applications/{driverApplication}', [AdminDriverApplicationController::class, 'destroy'])->name('driver-applications.destroy');
    });

/*
|--------------------------------------------------------------------------
| CMS Pages (Keep LAST)
|--------------------------------------------------------------------------
*/

Route::get('/{slug}', [PageController::class, 'show'])->name('pages.show');