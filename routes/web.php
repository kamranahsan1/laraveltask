<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

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
Route::get('/',         [HomeController::class, 'welcome'])->name('welcome');
Route::get('/login',    [LoginController::class, 'index'])->name('login');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/logout',   [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'webjwt'], function () {
    Route::get('/home',     [HomeController::class, 'index'])->name('home');
    Route::get('/products/list', [ProductController::class, 'index'])->name('products.list');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/products/show/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
});

Route::group(['namespace' => 'api','prefix' => 'api'], function () {
    require base_path('routes/api.php');
});