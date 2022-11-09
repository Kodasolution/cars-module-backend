<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\VoitureUpdateRequest;
use App\Http\Resources\VoitureByAgenceResource;
use App\Http\Resources\VoitureResource;
use App\Http\Resources\VoitureResourceDetail;
use App\Models\Article;
use App\Models\Entreprise;
use App\Models\Equipement;
use App\Models\LigneEquipementsVoiture;
use App\Models\Marque;
use App\Models\Modele;
use App\Models\Photos;
use App\Models\TypeVoiture;
use App\Models\Voiture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VoitureController extends Controller
{
    /**
     * five car principal for index
     * @return \Illuminate\Http\Response
     */

    public function voitureFiveFirst()
    {
        $voiture = Voiture::paginate(5);
        if (sizeof($voiture) == 0) {
            return $this->sendError('Voiture not found.');
        }
        return $this->sendResponse(VoitureResourceDetail::collection($voiture), 'fetch is called Successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voiture = Voiture::all();
        if (sizeof($voiture) == 0) {
            return $this->sendError('No Voiture yet.');
        }
        return $this->sendResponse(VoitureResourceDetail::collection($voiture), 'fetch is called Successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $entrepriseExist = Entreprise::find($request->entreprise_id);
            if (is_null($entrepriseExist)) {
                return $this->sendError('entreprise_id not found.');
            }
            $dataArticle = $request->validate([
                "nom_article" => "required|unique:articles,nom_article",
                "prix_article" => "required",
                "type_article" => "required",
                "entreprise_id" => "required",
                "slug_nom_article" => "",
                "actif" => "",
                "nombre_view" => "",

                "plaque" => "required|unique:voiture,plaque",
                "boite_de_vitesse" => "required",
                "kilometrage" => "required",
                "numero_de_chassis" => "required",
                "couleur" => "required",
                "carburant" => "required",
                "volant" => "required",
                "nombre_places" => "required",
                "nombre_portes" => "required",
                "annee_de_fabrication" => "required",
                "type_voiture_id" => "required",
                "model_id" => "required",
                "entreprise_id" => "required",
                "valide" => 'boolean',
                "en_location" => 'boolean',
                "active" => 'boolean',
                "condition_de_location" => "",
                "slug_nom_vehicule" => "",
                "consommation" => "",
                "capacite_charge_max" => "",
                "version" => "",
            ]);
            Article::create([
                "nom_article" => $request->nom_article,
                "prix_article" => $request->prix_article,
                "type_article" => $request->type_article,
                "entreprise_id" => $request->entreprise_id,
                "slug_nom_article" => $request->slug_nom_article,
                "actif" => $request->actif,
                "nombre_view" => $request->nombre_view,
            ]);
            $article_id = DB::getPdo()->lastInsertId();
            $ModelExist = Modele::find($request->model_id);
            $typeExist = TypeVoiture::find($request->type_voiture_id);
            if (is_null($ModelExist)) {
                return $this->sendError('model_id not found.');
            }
            if (is_null($typeExist)) {
                return $this->sendError('type_voiture_id not found.');
            }
            $voiture = Voiture::create([
                "article_id" => $article_id,
                "plaque" => $request->plaque,
                "boite_de_vitesse" => $request->boite_de_vitesse,
                "kilometrage" => $request->kilometrage,
                "numero_de_chassis" => $request->numero_de_chassis,
                "couleur" => $request->couleur,
                "carburant" => $request->carburant,
                "volant" => $request->volant,
                "nombre_places" => $request->nombre_places,
                "nombre_portes" => $request->nombre_portes,
                "annee_de_fabrication" => $request->annee_de_fabrication,
                "type_voiture_id" => $request->type_voiture_id,
                "model_id" => $request->model_id,

                // "valide" => $request->valide,
                // "en_location" => $request->en_location,
                // "version"=>$request->version,
                // "poids"=>$request->poid,

                "condition_de_location" => $request->condition_de_location,
                "consommation" => $request->consommation,
                "capacite_charge_max" => $request->capacite_charge_max,
            ]);
            $voiture_id = DB::getPdo()->lastInsertId();
            if ($this->marqueDouble($request, "equipement") === true) {
                if (!is_null($request->equipement)) {
                    foreach ($request->equipement as $item) {
                        if ($item['equipement_id'] != 0) {
                            $equipementExist = Equipement::find($item['equipement_id']);
                            if (is_null($equipementExist)) {
                                return $this->sendError('equipement_id not found.');
                            }
                            LigneEquipementsVoiture::create([
                                'voiture_id' => $voiture_id,
                                'equipement_id' => $item['equipement_id'],
                            ]);
                        } else {
                            return $this->sendError('choice the equipements.');
                        }
                    }
                } else {
                    return $this->sendError('equipements is required.');
                }
            } else {
                return $this->sendError('we have selected same equipements change it');
            }
            if (!is_null($request->photo)) {
                foreach ($request->photo as $item) {
                    $file = $item->store("voitureImages", "public");
                    Photos::create([
                        "article_id" => $article_id,
                        "url_photo" => $file,
                    ]);
                }
            } else {
                return $this->sendError('Photo is required.');
            }
            DB::commit();
            return $this->sendResponse(new VoitureResource($voiture), 'Voiture Created Successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError('error in process of save car.');

        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $voiture = Voiture::find($id);
        if (is_null($voiture)) {
            return $this->sendError('Voiture not found.');
        }
        return $this->sendResponse(new VoitureResource($voiture), 'Voiture is fetching Successfully .');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VoitureUpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $voitureExist = Voiture::where('id', $id)->exists();
            $ModelExist = Modele::find($request->model_id);
            $entrepriseExist = Entreprise::find($request->entreprise_id);
            $typeExist = TypeVoiture::find($request->type_voiture_id);
        
            if (is_null($ModelExist)) {
                return $this->sendError('model_id not found.');
            }
            if (is_null($entrepriseExist)) {
                return $this->sendError('entreprise_id not found.');
            }
            if (is_null($typeExist)) {
                return $this->sendError('type_voiture_id not found.');
            }
            if ($voitureExist == null) {
                return $this->sendError('Voiture is not exist.');
            }
            $voiture = Voiture::findOrFail($id);
            $voiture->update([
                "nom_voiture" => $request->nom_voiture,
                "plaque" => $request->plaque,
                "boite_de_vitesse" => $request->boite_de_vitesse,
                "kilometrage" => $request->kilometrage,
                "numero_de_chassis" => $request->numero_de_chassis,
                "couleur" => $request->couleur,
                "carburant" => $request->carburant,
                "volant" => $request->volant,
                "nombre_places" => $request->nombre_places,
                "nombre_portes" => $request->nombre_portes,
                "annee_de_fabrication" => $request->annee_de_fabrication,
                "prix" => $request->prix,
                "type_voiture_id" => $request->type_voiture_id,
                "model_id" => $request->model_id,
                "entreprise_id" => $request->entreprise_id,
                "marque_id" => $request->marque_id,
                // "valide" => $request->valide,
                // "en_location" => $request->en_location,
                // "active" => $request->active,
                "condition_de_location" => $request->condition_de_location,
                "slug_nom_vehicule" => $request->slug_nom_vehicule,
                "consommation" => $request->consommation,
                "capacite_charge_max" => $request->capacite_charge_max,
            ]);
            $voiture->ligneVoitureEquipements()->delete();
            if ($this->marqueDouble($request, "equipement") === true) {
                if (!is_null($request->equipement)) {
                    foreach ($request->equipement as $item) {
                        if ($item['equipement_id'] != 0) {
                            $equipementExist = Equipement::find($item['equipement_id']);
                            if (is_null($equipementExist)) {
                                return $this->sendError('equipement_id not found.');
                            }
                            LigneEquipementsVoiture::create([
                                'voiture_id' => $voiture->id,
                                'equipement_id' => $item['equipement_id'],
                            ]);
                        } else {
                            return $this->sendError('choice the equipements.');
                        }
                    }
                }
            } else {
                return $this->sendError('we have selected same equipements change it');
            }
            if (!is_null($request->photo)) {
                foreach ($request->photo as $item) {
                    $file = $item->store("voitureImages/" . $voiture->id, "public");
                    $voiture->Photos()->update([
                        "voiture_id" => $voiture->id,
                        "url_photo" => $file,
                    ]);
                }
            } else {
                return $this->sendError('Photo is required.');
            }
            DB::commit();
            return $this->sendResponse(new VoitureResource($voiture), 'Voiture Updated Successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError('error in process of save car.');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $voitureExist = Voiture::where('id', $id)->exists();
        if ($voitureExist == null) {
            return $this->sendError('Voiture is not exist.');
        }
        $voiture = Voiture::findOrFail($id);
        $voiture->delete();
        return $this->sendResponse([], 'Voiture Deleted Successfully.');
    }
    public function voitureDetail()
    {
        $voiture = Voiture::all();
        if (sizeof($voiture) == 0) {
            return $this->sendError('Voiture not found.');
        }
        return $this->sendResponse(VoitureResourceDetail::collection($voiture), 'Voiture Updated Successfully.');

    }
    public function voitureDetailOne($id)
    {
        $voitureExist = Voiture::where('id', $id)->exists();
        if ($voitureExist == null) {
            return $this->sendError('Voiture is not exist.');
        }
        $voiture = Voiture::findOrFail($id);
        return $this->sendResponse(new VoitureResourceDetail($voiture), 'Voiture Updated Successfully.');

    }

    public function voitureByAgence()
    {
        if (Auth::check() && Auth::user()->role === "admin") {
            $entrepriseExist = Entreprise::where('id', Auth::user()->id)->exists();
            if ($entrepriseExist == null) {
                return $this->sendError('Entreprise is not exist.');
            }
            $entreprise = Entreprise::findOrFail(Auth::user()->id);
            return $this->sendResponse(new VoitureByAgenceResource($entreprise), 'all voiture by agences.');
        } else {
            return $this->sendError('not connect Login plz.');

        }
    }

    public function marqueDouble($request, $nameRepeat)
    {
        $equipement = [];
        $isOk = false;
        foreach ($request[$nameRepeat] as $value) {
            $equipement[] = $value['equipement_id'];
        }
        if (array_unique($equipement) === $equipement) {
            $isOk = true;
        } else {
            $isOk;
        }
        return $isOk;
    }
}
