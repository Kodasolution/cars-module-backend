<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\MarqueController;
use App\Http\Controllers\api\ModeleController;
use App\Http\Controllers\api\ParametreController;
use App\Http\Controllers\api\TypeVoitureController;
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
    Route::apiResource("/marque", MarqueController::class);
    Route::apiResource("/modele",ModeleController::class);
    Route::apiResource("/parametre",ParametreController::class);
    Route::apiResource("/type",TypeVoitureController::class);

});
