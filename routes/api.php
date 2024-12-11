<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProspectApiController;
use App\Http\Controllers\ClientApiController;
use App\Http\Controllers\ContenirApiController;
use App\Http\Controllers\FactureApiController;
use App\Http\Controllers\ProduitApiController;
use App\Http\Controllers\RdvApiController;
use App\Http\Controllers\CommercialApiController;





/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->group(function () {
    Route::put('contenirs/{idProd}/{idFact}', [ContenirApiController::class, 'update']);
    Route::delete('contenirs/{idProd}/{idFact}', [ContenirApiController::class, 'destroy']);
    Route::apiResource('prospects', ProspectApiController::class);
    Route::apiResource('factures', FactureApiController::class);
    Route::apiResource('clients', ClientApiController::class);
    Route::apiResource('contenirs', ContenirApiController::class);
    Route::apiResource('produits', ProduitApiController::class);
    Route::apiResource('rdvs', RdvApiController::class);
    Route::apiResource('commerciaux', CommercialApiController::class);
});
Route::post('login', [CommercialApiController::class, 'login'])->name('commerciaux.login');