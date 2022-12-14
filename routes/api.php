<?php

use App\Http\Controllers\api\AdminController;
use App\Http\Controllers\api\AdresseController;
use App\Http\Controllers\api\ArticleController;
use App\Http\Controllers\api\ChambreController;
use App\Http\Controllers\api\ClientController;
use App\Http\Controllers\api\CommuneController;
use App\Http\Controllers\api\ComoditeController;
use App\Http\Controllers\api\EntrepriseController;
use App\Http\Controllers\api\EquipementController;
use App\Http\Controllers\api\FavoryController;
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
use App\Http\Controllers\api\QuartierController;
use App\Http\Controllers\api\SalleController;
use App\Http\Controllers\api\TypeChambreController;
use App\Http\Controllers\api\TypeSalleController;
use App\Http\Controllers\api\TypeVoitureController;
use App\Http\Controllers\api\UtilisateurController;
use App\Http\Controllers\api\VoitureController;
use App\Http\Controllers\api\ZoneController;
use App\Models\Comodite;
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
    Route::group(['prefix' => 'admin'], function () {
        Route::group(['middleware' => ['auth:sanctum', "roles:super_admin"]], function () {
            Route::apiResource("/voiture/marque", MarqueController::class);
            Route::apiResource("/voiture/modele", ModeleController::class);
            Route::apiResource("/voiture/parametre", ParametreController::class);
            Route::apiResource("/voiture/type", TypeVoitureController::class);
            Route::apiResource("/voiture/equipement", EquipementController::class);
            Route::apiResource("/province", ProvinceController::class);
            Route::apiResource("/commune", CommuneController::class);
            Route::apiResource("/zone",ZoneController::class);
            Route::apiResource("/quartier",QuartierController::class);
            Route::apiResource("/adresse", AdresseController::class);
            Route::apiResource("/entreprise", EntrepriseController::class);
            Route::apiResource("/user",UtilisateurController::class);
            Route::patch("/entreprise/change-status/{id}",[EntrepriseController::class,'changeStatusEntreprise'])->name("entreprise.change.status");
            Route::get("/entreprise/by-status/{status}",[EntrepriseController::class,'EntrepriseByStatus'])->name("entreprise.by.status");
            Route::get("/entreprise-detail",[EntrepriseController::class,'DetailEntreprise'])->name('entreprise.detatail.all');
            Route::get("/entreprise-detail/{id}",[EntrepriseController::class,'DetailOneEntreprise'])->name('entreprise.detatail.one');
            Route::get("/manager",[AdminController::class,'index']);
            Route::get("/manager/{id}",[AdminController::class,'show']);
        });
        Route::group(['middleware' => ['auth:sanctum', 'roles:super_admin|admin']], function () {
            Route::apiResource("/voiture", VoitureController::class);
            Route::get("/voiture-principale",[VoitureController::class,'voitureFiveFirst']);
            Route::get("/voiture-detail",[VoitureController::class,'voitureDetail']);
            Route::get("/voiture-detail/{id}",[VoitureController::class,'voitureDetailOne']);
            Route::get("/voiture-by-entreprise",[VoitureController::class,'voitureByAgence']);
            Route::apiResource("/voiture/photo", PhotoController::class);
            Route::apiResource("/voiture/ligne/equipement", LigneEquipementVoitureController::class);
            Route::apiResource("/voiture/ligne-location-voiture", LigneLocationVoitureController::class);
            Route::get("/client",[ClientController::class, 'index']);
            Route::get("/client/{id}",[ClientController::class, 'show']);
            Route::apiResource("/location", LocationController::class);
            Route::apiResource("/location-entreprise", LocationEntrepriseController::class);
            Route::post("/type-chambre",[TypeChambreController::class,'store']);
            Route::post("/type-salle",[TypeSalleController::class,'store']);
            Route::post("/comodite",[ComoditeController::class,'store']);
            Route::post("/chambre",[ChambreController::class,'store']);
            Route::post("/salle",[SalleController::class,'store']);

        });
        Route::group(['middleware' =>['auth:sanctum','roles:client']],function(){
            Route::apiResource("/favory",FavoryController::class); 
            Route::get("/favories/{article}",[FavoryController::class,'favorite']); 
        });
        Route::post("/register", [LoginController::class, 'Register']);
        Route::post("/login", [LoginController::class, 'Login']);
        Route::get("/type-chambre",[TypeChambreController::class,'index']);
        Route::get("/type-chambre/{id}",[TypeChambreController::class,'show']);
        Route::get("/type-salle",[TypeSalleController::class,'index']);
        Route::get("/type-salle/{id}",[TypeSalleController::class,'show']);
        Route::get("/comodite",[ComoditeController::class,'index']);
        Route::get("/comodite/{id}",[ComoditeController::class,'show']);
        Route::get("/chambre",[ChambreController::class,'index']);
        Route::get("/chambre/{id}",[ChambreController::class,'show']);
        Route::get("/salle",[SalleController::class,'index']);
        Route::get("/salle/{id}",[SalleController::class,'show']);
    });
});
