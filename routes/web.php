<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\ContenirController;
use App\Http\Controllers\RdvController;
use App\Http\Controllers\CommercialController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('clients',ClientController::class);
    Route::resource('commercial',CommercialController::class);
    Route::resource('rdv',RdvController::class);
    Route::resource('produits',ProduitController::class);
    Route::resource('factures',FactureController::class);
    Route::get('/contenir/create/{facture_id}', [ContenirController::class, 'create'])->name('contenir.create');
    Route::delete('/contenir/delete/{facture_id}/{produit_id}', [ContenirController::class, 'destroy'])->name('contenir.destroy');
    Route::post('/contenir/store', [ContenirController::class, 'store'])->name('contenirs.store');
    Route::get('factures/contenirs/{idFact}/{idProd}', [ContenirController::class, 'edit'])->name('factures.contenirs.edit');
    Route::put('factures/contenirs/{idFact}/{idProd}', [ContenirController::class, 'update'])->name('contenirs.update');
    Route::get('commercial/{id}', [CommercialController::class, 'show'])->name('commercial.show');
    
});

Route::put('factures/contenirs/{idFact}/{idProd}', [ContenirController::class, 'update'])->name('contenirs.update');