<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ProvinciaController;
use App\Http\Controllers\Api\ComarcaController;
use App\Http\Controllers\Api\MunicipiController;

use App\Http\Controllers\CartesTrucadesController;

Route::post('/cartes-trucades', [CartesTrucadesController::class, 'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/provincies', [ProvinciaController::class, 'index']);
Route::get('/provincies/{id}/comarques', [ProvinciaController::class, 'comarcas']);
Route::get('/comarques/{id}/municipis', [ComarcaController::class, 'municipis']);
