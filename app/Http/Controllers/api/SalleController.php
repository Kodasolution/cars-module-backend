<?php

namespace App\Http\Controllers\api;

use App\Models\Salle;
use App\Models\Photos;
use App\Models\Article;
use App\Models\Comodite;
use App\Models\TypeSalle;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use App\Models\LigneComoditeSalle;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\DetailResourceSalle;
use App\Http\Resources\SalleResource;

class SalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salle = Salle::all();
        if (sizeof($salle) == 0) {
            return $this->sendError('no found.');
        }
        return $this->sendResponse(DetailResourceSalle::collection($salle), 'fetch is called Successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
            "numero_salle" => "required|unique:salles,numero_salle",
            "type_salle_id" => "required",
            "surface_salle" => "required",
            "capacite_accueil" => "required",
            "description_salle" => "",
            "libre" => "",
            "valide" => "",

        ]);
        DB::beginTransaction();
        try {
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
            $typeSalleExist = TypeSalle::find($request->type_salle_id);

            if (is_null($typeSalleExist)) {
                return $this->sendError('type_salle_id not found.');
            }
            $salle = Salle::create([
                "article_id" => $article_id,
                "numero_salle"=>$request->numero_salle,
                "type_salle_id" => $request->type_salle_id,
                "surface_salle" => $request->surface_salle,
                "capacite_accueil" => $request->capacite_accueil,
                "description_salle" => $request->description_salle,

            ]);
            $salle_id = DB::getPdo()->lastInsertId();
            if ($this->marqueDouble($request, "comodite") === true) {
                if (!is_null($request->comodite)) {
                    foreach ($request->comodite as $item) {
                        if ($item['comodite_id'] != 0) {
                            $comoditeExist = Comodite::find($item['comodite_id']);
                            if (is_null($comoditeExist)) {
                                return $this->sendError('comodite_id not found.');
                            }
                            LigneComoditeSalle::create([
                                'salle_id' => $salle_id,
                                'comodite_id' => $item['comodite_id'],
                            ]);
                        } else {
                            return $this->sendError('choice the equipements.');
                        }
                    }
                } else {
                    return $this->sendError('comodite is required.');
                }
            } else {
                return $this->sendError('we have selected same equipements change it');
            }
            if (!is_null($request->photo)) {
                foreach ($request->photo as $item) {
                    $file = $item->store("salleImage", "public");
                    Photos::create([
                        "article_id" => $article_id,
                        "url_photo" => $file,
                    ]);
                }
            } else {
                return $this->sendError('Photo is required.');
            }
            DB::commit();
            return $this->sendResponse(new SalleResource($salle), 'Chambre Created Successfully.');
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

        $salle = Salle::find($id);
        if (is_null($salle)) {
            return $this->sendError('chambre not found.');
        }
        return $this->sendResponse(new DetailResourceSalle($salle), 'Salles is fetching Successfully .');
    }

    public function marqueDouble($request, $nameRepeat)
    {
        $comodite = [];
        $isOk = false;
        foreach ($request[$nameRepeat] as $value) {
            $comodite[] = $value['comodite_id'];
        }
        if (array_unique($comodite) === $comodite) {
            $isOk = true;
        } else {
            $isOk;
        }
        return $isOk;
    }
}
