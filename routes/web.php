<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\Category;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Checklogin;
use Illuminate\Routing\Controllers\Middleware;
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

Route::get('/', function () {
    return view('main.login');
});
Route::post('/login',[UserController::class,'login']);

// Route::middleware(Checklogin::class)->group(function () {

Route::controller(Category::class)->group(function(){
    Route::get('/cate','index');
    Route::post('/addcate','store')->name('addcate');
    Route::delete('/deleteCate', 'destroy');
    Route::post('/{id}/updateCate', 'update');
    Route::get('/export', 'export')->name('exportexcel');

    // Route::delete('{formId}/delete', [AbcController::class, 'delete'])->name('delete');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/users','index');
    Route::post('/CreateUser','store');
    Route::post('/DeleteUser','destroy');
    Route::get('/{id}/abc','edit')->name( 'abc' );
    Route::post('/detailUser1','update');
});

Route::controller(RoleController::class)->group(function () {
    Route::get('/role','index')->name('role');
    // Route::get('/createRoles','create');
    Route::post('/createRole','store');
    Route::post('/deleteRole','destroy');
    Route::post('/{id}/updateRole','update');

});

Route::controller(CarController::class)->group(function () {
    Route::get('/cars','index')->name('cars');
    // Route::get('/createRoles','create');
    // Route::post('/createRole','store');
    // Route::post('/deleteRole','destroy');
    Route::post('/importcars','import');
});
// Route::get('users/index/abc', [ABCController::class, 'index'])->name('users.abc');
// {{route("users.abc")}};

// });
