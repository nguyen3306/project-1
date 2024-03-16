<?php

use App\Http\Controllers\Category;
use App\Http\Controllers\RoleController;
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
Route::controller(Category::class)->group(function(){
    Route::get('/cate','index');
    Route::post('/addcate','store')->name('addcate');
    Route::delete('/deleteCate', 'destroy');
    Route::post('/{id}/updateCate', 'update');
    // Route::delete('{formId}/delete', [AbcController::class, 'delete'])->name('delete');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/users','index');
    Route::post('/CreateUser','store');
});
Route::post('/',[UserController::class,'login']);

Route::controller(RoleController::class)->group(function () {
    Route::get('/role','index');
    Route::post('/createRole','store');
    Route::post('/deleteRole','destroy');
});
// Route::get('users/index/abc', [ABCController::class, 'index'])->name('users.abc');
// {{route("users.abc")}};