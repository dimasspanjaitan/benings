<?php

use Illuminate\Support\Facades\Route;
// use Auth;
use App\Http\Controllers\{
    AdminController,
    AuthController,
    CategoryController,
    FrontendController,
    HomeController,
    ProductController,
    UsersController,
    LevelController,
    RegionController
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








// Backend section start
Route::group(['prefix'=>'/admin','middleware'=>['auth','admin']],function(){
    Route::get('/', [AdminController::class, 'index'])->name('admin');

    Route::resource('/product', ProductController::class);
    Route::resource('/category', CategoryController::class);
    Route::resource('/users', UsersController::class);
    Route::resource('/level', LevelController::class);
    Route::resource('/region', RegionController::class);
});








// User section start
Route::group(['prefix'=>'/user','middleware'=>['user']],function(){
    Route::get('/', [HomeController::class, 'index'])->name('user');

    
});