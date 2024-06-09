<?php

use App\Http\Controllers\Category;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\OdersController;
use App\Http\Controllers\RoleController;
use App\Http\Middleware\Checklogin;
use Illuminate\Routing\Controllers\Middleware;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::post('/login',[UserController::class,'login']);


// Route::controller(Category::class)->group(function(){
//     Route::get('/chitiet','show');
//     Route::post('/addcate','store');
//     Route::delete('/deleteCate', 'destroy');
//     Route::post('/{id}/updateCate', 'update');
//     Route::get('/export', 'export')->name('exportexcel');

//     // Route::delete('{formId}/delete', [AbcController::class, 'delete'])->name('delete');
// });

// Route::controller(UserController::class)->group(function () {
//     Route::get('/users','index');
//     Route::post('/CreateUser','store');
//     Route::post('/DeleteUser','destroy');
//     Route::get('/{id}/editUser','edit')->name( 'EditUser' );
//     Route::post('/UpdateUser','update')->name('UpdateUser');
// });

// Route::controller(RoleController::class)->group(function () {
//     Route::get('/role','index')->name('role');
//     // Route::get('/createRoles','create');
//     Route::post('/createRole','store');
//     Route::post('/deleteRole','destroy');
//     Route::post('/{id}/updateRole','update');

// });

// Route::controller(CarController::class)->group(function () {
//     Route::get('/cars','index')->name('cars');
//     // Route::get('/createRoles','create');
//     Route::post('/createCar','store');
//     Route::post('/DeleteCar','destroy');
//     Route::post('/importcars','import');
//     Route::post('/test','test')->name('test');
//     Route::get('/{id}/editCar','edit')->name( 'EditCar' );
//     Route::post('/UpdateCar','update')->name( 'UpdateCar' );

// });
// // Route::get('users/index/abc', [ABCController::class, 'index'])->name('users.abc');
// // {{route("users.abc")}};

// // });

// Route::controller(OdersController::class)->group(function () {
// Route::get('/Oder','index');
// // Route::get('/createRoles','create');
// Route::post('/getOder','store')->name('getOder');
// // Route::post('/deleteRole','destroy');
// // Route::post('/{id}/updateRole','update');

// });



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::controller(Category::class)->group(function(){
//     // Route::post('/addcate','store')->name('addcate');
//     Route::delete('/deleteCate', 'destroy');
//     Route::post('/{id}/updateCate', 'update');
    
//     // Route::delete('{formId}/delete', [AbcController::class, 'delete'])->name('delete');
// });

// Route::controller(UserController::class)->group(function () {
//     Route::post('/CreateUser','store');
// });