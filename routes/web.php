<?php

use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\TrattativaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VivereDiRenditaController;
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

/*
|--------------------------------------------------------------------------
| Start Login
|--------------------------------------------------------------------------
*/
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registrazione', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
/*
|--------------------------------------------------------------------------
| End login
|--------------------------------------------------------------------------
*/

Route::get('/', [ProductionController::class, 'main'])->name('produzione.main');

Route::get('/produzione', [ProductionController::class, 'main'])->name('produzione.main');
Route::get('/produzione/tab', [ProductionController::class, 'index'])->name('produzione.index');
Route::get('/produzione/opzioni', [ProductionController::class, 'opzioni'])->name('produzione.opzioni');
Route::post('/produzione/opzioni/savePolizzeEscluse', [ProductionController::class, 'savePolizzeEscluse'])->name('produzione.savePolizzeEscluse');
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
Route::get('/produzione/obiettivo-2-semestre/', [ProductionController::class, 'obiettivoSecondoSemestre'])->name('produzione.gare.obiettiviSemestre');

//update gare
Route::get('/updateObiettivoGaraPaNoProt/', [ProductionController::class, 'updateObiettivoGaraPaNoProt'])->name('updateObiettivoGaraPaNoProt');
Route::get('/updateObiettivoGaraProt/', [ProductionController::class, 'updateObiettivoGaraProt'])->name('updateObiettivoGaraProt');
Route::get('/updateObiettivoGaraAvc/', [ProductionController::class, 'updateObiettivoGaraAvc'])->name('updateObiettivoGaraAvc');
Route::get('/updateObiettivoGaraDnaPlus/', [ProductionController::class, 'updateObiettivoGaraDnaPlus'])->name('updateObiettivoGaraDnaPlus');

//update obiettivi annuo
Route::get('/updateObiettivoAnnuoPaNoProt/', [ProductionController::class, 'updateObiettivoAnnuoPaNoProt'])->name('updateObiettivoAnnuoPaNoProt');
Route::get('/updateObiettivoAnnuoProt/', [ProductionController::class, 'updateObiettivoAnnuoProt'])->name('updateObiettivoAnnuoProt');
Route::get('/updateObiettivoAnnuoAvc/', [ProductionController::class, 'updateObiettivoAnnuoAvc'])->name('updateObiettivoAnnuoAvc');
Route::get('/updateObiettivoAnnuoDnaRetail/', [ProductionController::class, 'updateObiettivoAnnuoDnaRetail'])->name('updateObiettivoAnnuoDnaRetail');
Route::get('/updateObiettivoAnnuoDnaMiddle/', [ProductionController::class, 'updateObiettivoAnnuoDnaMiddle'])->name('updateObiettivoAnnuoDnaMiddle');
Route::get('/updateObiettivoAnnuoRca/', [ProductionController::class, 'updateObiettivoAnnuoRca'])->name('updateObiettivoAnnuoRca');

//update semestre
Route::get('/updateObiettivoSemestrePaNoProt/', [ProductionController::class, 'updateObiettivoSemestrePaNoProt'])->name('updateObiettivoSemestrePaNoProt');
Route::get('/updateObiettivoSemestreProt/', [ProductionController::class, 'updateObiettivoSemestreProt'])->name('updateObiettivoSemestreProt');
Route::get('/updateObiettivoSemestreAvc/', [ProductionController::class, 'updateObiettivoSemestreAvc'])->name('updateObiettivoSemestreAvc');
Route::get('/updateObiettivoSemestreDnaMiddle/', [ProductionController::class, 'updateObiettivoSemestreDnaMiddle'])->name('updateObiettivoSemestreDnaMiddle');
Route::get('/updateObiettivoSemestreDnaRetail/', [ProductionController::class, 'updateObiettivoSemestreDnaRetail'])->name('updateObiettivoSemestreDnaRetail');

//trattativa
Route::get('/trattativa/{id?}', [TrattativaController::class, 'index'])->name('trattativa.index');
Route::get('/trattativa/pdf/{idTrattativa}', [TrattativaController::class, 'pdf'])->name('trattativa.pdf');
Route::post('/trattativa/salvaTabellaBisogni/{idTrattativa?}', [TrattativaController::class, 'salvaTabellaBisogni'])->name('trattativa.salvaTabellaBisogni');

Route::get('/vivere-di-rendita/simulazione.php')->name('vivereDiRendita.index');

//fileimport
Route::controller(UserController::class)->group(function(){
    Route::get('users', 'index');
    Route::get('users-export', 'export')->name('users.export');
    Route::post('users-import', 'import')->name('users.import');
});

