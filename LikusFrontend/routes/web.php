<?php

use Illuminate\Support\Facades\Route;
use MicroweberPackages\Category\Models\Category;
use MicroweberPackages\Category\Models\CategoryItem;
use MicroweberPackages\Content\Models\Content;

use App\Http\Controllers\WebserviceController;

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

//Routes za upravljanje članov
Route::get('/clani', [WebserviceController::class, 'allMembers'])->name('clani');
Route::get('/clan/{id}', [WebserviceController::class, 'getMember']);


//Routes za opravljanje knjižnice
Route::get('/knjige', [WebserviceController::class, 'allBooks'])->name('knjige');
Route::get('/knjiga/{id}', [WebserviceController::class, 'getBook']);
Route::get('/preberi/{id}', [WebserviceController::class, 'getClankiPerBook']);

//proxy
