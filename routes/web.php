<?php

use App\Http\Controllers\EstablecimientoController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);
 
Route::group(['middleware' => ['auth', 'verified']], function(){
    Route::get('/establecimiento/create', [EstablecimientoController::class, 'create'])->name('establecimiento.create');
    Route::get('/establecimiento/edit', [EstablecimientoController::class, 'create'])->name('establecimiento.edit');
});

