<?php

use App\Http\Controllers\api\AdresseController;
use App\Http\Controllers\api\ClientController;
use App\Http\Controllers\api\CommuneController;
use App\Http\Controllers\api\EntrepriseController;
use App\Http\Controllers\api\EquipementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\MarqueController;
use App\Http\Controllers\api\ModeleController;
use App\Http\Controllers\api\ParametreController;
use App\Http\Controllers\api\ProvinceController;
use App\Http\Controllers\api\TypeVoitureController;
use App\Http\Controllers\api\VoitureController;
use App\Models\TypeVoiture;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */
Route::prefix("v1")->group(function () {

    Route::prefix("voiture")->group(function(){
        Route::apiResource("/automobile",VoitureController::class);
        Route::apiResource("/adresse" ,AdresseController::class);
        Route::apiResource("/marque", MarqueController::class);
        Route::apiResource("/modele",ModeleController::class);
        Route::apiResource("/parametre",ParametreController::class);
        Route::apiResource("/type",TypeVoitureController::class);
        Route::apiResource("/equipement",EquipementController::class);
        Route::apiResource("/entreprise",EntrepriseController::class);
        Route::apiResource("/province",ProvinceController::class);
        Route::apiResource("/commune",CommuneController::class);
        Route::apiResource("/client",ClientController::class);
        
    });
});
