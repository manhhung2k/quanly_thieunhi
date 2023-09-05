<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChildrenController;
use App\Http\Controllers\HotelController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Hotel
Route::get('/children',[ChildrenController::class,'index']);
Route::post('/children/create',[ChildrenController::class,'store']);
Route::delete('/children/{id}', [ChildrenController::class, 'destroy']);
Route::get('/children/edit/{id}', [ChildrenController::class, 'edit']);
Route::post('/children/update/{id}', [ChildrenController::class, 'update']);

