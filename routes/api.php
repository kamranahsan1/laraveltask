<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login', [LoginController::class, 'login'])->name('api.login');
Route::post('/register', [RegisterController::class, 'register'])->name('api.register');

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/logout', [LoginController::class, 'logout']);
    
    Route::get('product/list', [ProductController::class, 'list'])->name('api.product.list');
    Route::post('product/create', [ProductController::class, 'store'])->name('api.product.store');
    Route::put('product/update/{id}', [ProductController::class, 'update'])->name('api.product.update');
    Route::DELETE('product/destroy/{id}', [ProductController::class, 'destroy'])->name('api.product.destroy');
});