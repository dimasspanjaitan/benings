<?php

use Illuminate\Support\Facades\Route;
// use Auth;
use App\Http\Controllers\{
    AdminController,
    AuthController,
    BannerController,
    CategoryController,
    FrontendController,
    HomeController,
    ProductController,
    UsersController,
    LevelController,
    RegionController,
    SaleController,
    PriceController,
    SupplierController,
    CartController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth::routes(['register'=>false]);

Route::get('/login',[AuthController::class, 'login'])->name('login');
Route::post('/login',[AuthController::class, 'loginSubmit'])->name('login.submit');
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

Route::get('/register',[FrontendController::class, 'register'])->name('register.form');
Route::post('/register',[FrontendController::class, 'registerSubmit'])->name('register.submit');

// Socialite 
Route::get('login/{provider}/', [AuthController::class, 'redirect'])->name('login.redirect');
Route::get('login/{provider}/callback/', [AuthController::class, 'callback'])->name('login.callback');

Route::get('/', [FrontendController::class, 'home'])->name('home');

// Route::group(['middleware'=>['auth']],function(){
//     Route::get('/', [FrontendController::class, 'home'])->name('home');
// });







// Frontend Routes
Route::get('/home', [FrontendController::class, 'index']);
Route::get('/about-us',[FrontendController::class, 'aboutUs'])->name('about-us');
Route::get('/contact',[FrontendController::class, 'contact'])->name('contact');
Route::get('product-detail/{slug}',[FrontendController::class, 'productDetail'])->name('product-detail');

Route::get('/product-grids', [FrontendController::class, 'productGrids'])->name('product-grids');
Route::get('/product-lists',[FrontendController::class, 'productLists'])->name('product-lists');
Route::post('/product/search', [FrontendController::class, 'productSearch'])->name('product.search');
Route::match(['get','post'],'/filter',[FrontendController::class, 'productFilter'])->name('shop.filter');
Route::get('/product-cat/{slug}',[FrontendController::class, 'productCat'])->name('product-cat');

Route::get('/wishlist',function(){
    return view('frontend.pages.wishlist');
})->name('wishlist');
Route::get('/cart',function(){
    return view('frontend.pages.cart');
})->name('cart');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout')->middleware('user');







// Backend section start
Route::group(['prefix'=>'/admin','middleware'=>['auth','admin']],function(){
    Route::get('/', [AdminController::class, 'index'])->name('admin');

    Route::resource('/product', ProductController::class);
    Route::resource('/category', CategoryController::class);
    Route::resource('/users', UsersController::class);
    Route::resource('/level', LevelController::class);
    Route::resource('/region', RegionController::class);
    Route::resource('/sale', SaleController::class);
    Route::resource('/price', PriceController::class);
    Route::resource('/banner', BannerController::class);
    Route::resource('/supplier', SupplierController::class);

    Route::get('settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('setting/update', [AdminController::class, 'settingsUpdate'])->name('settings.update');

    Route::group(['prefix'=>'/api'], function(){
        Route::post('sale/change-status', [SaleController::class, 'changeStatus'])->name('api.sale.change-status');
    });
});








// User section start
Route::group(['prefix'=>'/user','middleware'=>['user']],function(){
    Route::get('/', [HomeController::class, 'index'])->name('user');

    
});