<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\SorteioController;
use App\Http\Controllers\PresencaController;
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


    Route::resources([
      'jogador'=> JogadoresController::class,
      'presenca'=> PresencaController::class, 
      'sorteio'=> SorteioController::class    
    ]);
    Route::get('/', function () {
       return Redirect::to('/sorteio');
    });
    Route::any('presenca.search', [PresencaController::class, 'index'])->name('presenca.search');
    Route::post('sorteio.rand', [SorteioController::class, 'sorteio'])->name('sorteio.rand');
