<?php

namespace App\Http\Controllers\api;

use App\Models\Photos;
use App\Models\Article;
use App\Models\Chambres;
use App\Models\Comodite;
use App\Models\Entreprise;
use App\Models\TypeChambres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\LigneComoditeChambre;
use App\Http\Resources\ChambreResource;
use App\Http\Resources\DetailChambreResource;

class ChambreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chambre = Chambres::all();
        if (sizeof($chambre) == 0) {
            return $this->sendError('no found.');
        }
        return $this->sendResponse(DetailChambreResource::collection($chambre), 'fetch is called Successfully.');
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

            "numero_chambre" => "required|unique:chambres,numero_chambre",
            "type_chambre_id" => "required",
            "surface_chambre" => "required",
            "nombre_lits" => "required",
            "nombre_personnes" => "required",
            "description_chambre" => "",
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
            $typeChambreExist = TypeChambres::find($request->type_chambre_id);

            if (is_null($typeChambreExist)) {
                return $this->sendError('type_chambre_id not found.');
            }
            $chambre = Chambres::create([
                "numero_chambre" => $request->numero_chambre,
                "article_id" => $article_id,
                "type_chambre_id" => $request->type_chambre_id,
                "surface_chambre" => $request->surface_chambre,
                "nombre_lits" => $request->nombre_lits,
                "nombre_personnes" => $request->nombre_personnes,
                "description_chambre" => $request->description_chambre,

            ]);
            $chambre_id = DB::getPdo()->lastInsertId();
            if ($this->marqueDouble($request, "comodite") === true) {
                if (!is_null($request->comodite)) {
                    foreach ($request->comodite as $item) {
                        if ($item['comodite_id'] != 0) {
                            $comoditeExist = Comodite::find($item['comodite_id']);
                            if (is_null($comoditeExist)) {
                                return $this->sendError('comodite_id not found.');
                            }
                            LigneComoditeChambre::create([
                                'chambre_id' => $chambre_id,
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
                    $file = $item->store("chambreImage", "public");
                    Photos::create([
                        "article_id" => $article_id,
                        "url_photo" => $file,
                    ]);
                }
            } else {
                return $this->sendError('Photo is required.');
            }
            DB::commit();
            return $this->sendResponse(new ChambreResource($chambre), 'Chambre Created Successfully.');
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

        $chambre = Chambres::find($id);
        if (is_null($chambre)) {
            return $this->sendError('chambre not found.');
        }
        return $this->sendResponse(new DetailChambreResource($chambre), 'chambre is fetching Successfully .');
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
