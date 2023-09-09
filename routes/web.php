<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Trans;
use App\Http\Controllers\Main;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('home',[Main::class,'index']);

Route::post('/add',[Trans::class,'store']);
Route::get('/filter',[Trans::class,'filter']);
Route::get('/search',[Trans::class,'search']);
