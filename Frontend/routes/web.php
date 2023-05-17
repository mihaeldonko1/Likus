<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
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

Route::get('/clani', [WebserviceController::class, 'allMembers'])->name('clani');
Route::get('/test', [WebserviceController::class, 'pdfreader']);
Route::get('/clan/{id}', [WebserviceController::class, 'getMember']);