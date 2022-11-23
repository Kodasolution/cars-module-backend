<?php

namespace App\Http\Controllers\api;

use App\Models\Comodite;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ComoditeResource;

class ComoditeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comodite = Comodite::all();
        if (sizeof($comodite) == 0) {
            return $this->sendError('no found.');
        }
        return $this->sendResponse(ComoditeResource::collection($comodite), 'fetch is called Successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                "libelle_comodite" => "required|unique:type_salles,type_salle",
                "entreprise_id" => "required"
            ]
        );
        $entrepriseExist = Entreprise::find($request->entreprise_id);
        if (is_null($entrepriseExist)) {
            return $this->sendError('entreprise_id not found.');
        }
        $comodite = Comodite::create($request->all());
        return $this->sendResponse(new ComoditeResource($comodite), ' Comodite Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comodite = Comodite::find($id);
        if (is_null($comodite)) {
            return $this->sendError('comodite not found.');
        }
        return $this->sendResponse(new ComoditeResource($comodite), 'Comodite is fetching Successfully .');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
