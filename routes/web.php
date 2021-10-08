<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AnalizadorController;



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

Route::get('/', [AnalizadorController::class, 'index']);

Route::post('/force-users', [AnalizadorController::class, 'analizar'])->name('force-users');

Route::post('/stats', [AnalizadorController::class, 'stats'])->name('stats');

Route::post('/reset', [AnalizadorController::class, 'reset'])->name('reset');



