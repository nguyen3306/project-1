<?php

use App\Http\Controllers\Category;
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
    Route::get('/', 'index');
    // Route::post('/users', 'store');
    // Route::get('/logout', 'logout');

});