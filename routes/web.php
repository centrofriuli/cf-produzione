<?php

use App\Http\Controllers\ProductionController;
use App\Http\Controllers\UserController;
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

Route::get('/produzione', [ProductionController::class, 'main'])->name('produzione.main');
Route::get('/produzione-tab', [ProductionController::class, 'index'])->name('produzione.index');
Route::get('/produzione/dna', [ProductionController::class, 'dna'])->name('produzione.dna');
Route::get('/produzione/rca', [ProductionController::class, 'rca'])->name('produzione.rca');
Route::get('/produzione/vita', [ProductionController::class, 'vita'])->name('produzione.vita');
Route::get('/produzione/fondiPensione', [ProductionController::class, 'fondiPensione'])->name('produzione.fondiPensione');
Route::post('/produzione/vita-import', [ProductionController::class, 'vitaImport'])->name('produzione.vita-import');
Route::post('/produzione/dna-import', [ProductionController::class, 'dnaImport'])->name('produzione.dna-import');
Route::post('/produzione/rca-import', [ProductionController::class, 'rcaImport'])->name('produzione.rca-import');
Route::post('/produzione/fondiPensione-import', [ProductionController::class, 'fondiPensioneImport'])->name('produzione.fondiPensione-import');

//gare
Route::get('/produzione/gara-1-trimestre/', [ProductionController::class, 'garaPrimoTrimestre'])->name('produzione.gare.garaTrimestri');
Route::get('/produzione/gara-2-trimestre/', [ProductionController::class, 'garaSecondoTrimestre'])->name('produzione.gare.garaTrimestri');
Route::get('/produzione/gara-3-trimestre/', [ProductionController::class, 'garaTerzoTrimestre'])->name('produzione.gare.garaTrimestri');
Route::get('/produzione/gara-4-trimestre/', [ProductionController::class, 'garaQuartoTrimestre'])->name('produzione.gare.garaTrimestri');

//fileimport
Route::controller(UserController::class)->group(function(){
    Route::get('users', 'index');
    Route::get('users-export', 'export')->name('users.export');
    Route::post('users-import', 'import')->name('users.import');
});

