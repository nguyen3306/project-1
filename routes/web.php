<?php

use App\Http\Controllers\Category;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('main.home');
// });
Route::controller(Category::class)->group(function () {
    Route::get('/cate', 'index');
    // Route::post('/users', 'store');
    // Route::get('/logout', 'logout');
    
});
Route::controller(UserController::class)->group(function () {
    Route::get('/users','index');
});
// Route::get('users/index/abc', [ABCController::class, 'index'])->name('users.abc');        
// {{route("users.abc")}};