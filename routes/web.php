<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JogadoresController;
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
    return view('jogadores');
});
 Route::resource('jogadores', JogadoresController::class);
Route::get('/presenca', [JogadoresController::class, 'index_presenca'])->name('presenca');
Route::post('/presenca', [JogadoresController::class, 'storePresenca'])->name('presenca.save');
