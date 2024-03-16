<?php

use App\Http\Controllers\Category;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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