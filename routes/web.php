<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mhs;
use App\Http\Controllers\Layout;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [Layout::class,'home']);

Route::controller(Layout::class)->group(function(){
    Route::get('/layout/home', 'home');
    Route::get('/layout/index', 'index');
});

Route::controller(Mhs::class)->group(function () {
    Route::get('/mhs/index', 'index');
    Route::get('/mhs/tambah', 'add');
    Route::post('/mhs/simpan', 'save');
    Route::get('/mhs/edit/{nim}', 'edit');
    Route::put('/mhs/update', 'update');
    Route::delete('/mhs/hapus/{nim}', 'hapus');
});