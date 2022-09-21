<?php

use App\Http\Controllers\api\AdresseController;
use App\Http\Controllers\api\CommuneController;
use App\Http\Controllers\api\EntrepriseController;
use App\Http\Controllers\api\EquipementController;
use App\Http\Controllers\api\LigneEquipementVoitureController;
use App\Http\Controllers\api\LigneLocationVoitureController;
use App\Http\Controllers\api\LocationController;
use App\Http\Controllers\api\LocationEntrepriseController;
use App\Http\Controllers\api\LoginController;
use App\Http\Controllers\api\MarqueController;
use App\Http\Controllers\api\ModeleController;
use App\Http\Controllers\api\ParametreController;
use App\Http\Controllers\api\PhotoController;
use App\Http\Controllers\api\ProvinceController;
use App\Http\Controllers\api\TypeVoitureController;
use App\Http\Controllers\api\VoitureController;
use Illuminate\Support\Facades\Route;

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
Route::group(['prefix' => 'v1'], function () {
    Route::group(['middleware' => ['auth:sanctum', "super_admins:super_admin"]], function () {
        Route::apiResource("/adresse", AdresseController::class);
        // Route::apiResource("/client", ClientController::class);
        // Route::apiResource("/utilisateur", UtilisateurController::class);
    });
    Route::group(["prefix" => "voiture", 'middleware' => ['auth:sanctum', 'super_admins:super_admin|admin']], function () {
        Route::apiResource("/automobile", VoitureController::class);
        Route::apiResource("/marque", MarqueController::class);
        Route::apiResource("/modele", ModeleController::class);
        Route::apiResource("/parametre", ParametreController::class);
        Route::apiResource("/type", TypeVoitureController::class);
        Route::apiResource("/equipement", EquipementController::class);
        Route::apiResource("/entreprise", EntrepriseController::class);
        Route::apiResource("/province", ProvinceController::class);
        Route::apiResource("/commune", CommuneController::class);
        Route::apiResource("/location", LocationController::class);
        Route::apiResource("/photo", PhotoController::class);
        Route::apiResource("/location-entreprise", LocationEntrepriseController::class);
        Route::apiResource("/ligne-equipement-voiture", LigneEquipementVoitureController::class);
        Route::apiResource("/ligne-location-voiture", LigneLocationVoitureController::class);
    });
    Route::post("/register", [LoginController::class, 'Register']);
    Route::post("/login", [LoginController::class, 'Login']);
});
