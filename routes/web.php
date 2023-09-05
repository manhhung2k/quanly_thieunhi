<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChildrenController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\LayoutController;
use Illuminate\Support\Facades\Route;

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

//Layout
Route::get('/', [LayoutController::class, 'index']);

//Hotel
Route::get('/children',[ChildrenController::class, 'viewHotel'])->name('children');
Route::get('/children/create', [ChildrenController::class, 'viewCreate'])->name('create_children');
Route::get('/children/edit/{id}', [ChildrenController::class, 'edit'])->name('children_edit');

Route::get('/children/export', [ChildrenController::class, 'export']);
// routes/web.php

Route::get('/children/export-hotels/{category}', [ChildrenController::class,'exportHotels'])->name('export.children');
Route::post('/children/importExcel', [ChildrenController::class,'importExcelCSV']);
Route::get('/children/excel-csv-file', [ChildrenController::class, 'indexExcelCSV']);
