<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\VoitureStoreRequest;
use App\Http\Requests\VoitureUpdateRequest;
use App\Http\Resources\VoitureResource;
use App\Models\Adresse;
use App\Models\Entreprise;
use App\Models\Modele;
use App\Models\TypeVoiture;
use App\Models\Voiture;
use Illuminate\Http\Request;

class VoitureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voiture = Voiture::all();
        if (sizeof($voiture) == 0) {
            return $this->sendError('Voiture not found.');
        }
        return $this->sendResponse(VoitureResource::collection($voiture), 'fetch is called Successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VoitureStoreRequest $request)
    {
        $ModelExist = Modele::find( $request->model_id);
        $entrepriseExist = Entreprise::find( $request->entreprise_id);
        $adresseExist = Adresse::find( $request->adresse_id);
        $typeExist = TypeVoiture::find( $request->type_voiture_id);
        if(is_null($ModelExist)){
            return $this->sendError('model_id not found.');
        }
        if(is_null($entrepriseExist)){
            return $this->sendError('entreprise_id not found.');
        }
        if(is_null($adresseExist)){
            return $this->sendError('adresse_id not found.');
        }
        if(is_null($typeExist)){
            return $this->sendError('type_voiture_id not found.');
        }
        $voiture = Voiture::create($request->all());
        return $this->sendResponse(new VoitureResource($voiture), 'Voiture Created Successfully.');
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
        $voitureExist = Voiture::where('id', $id)->exists();
        if ($voitureExist == null) {
            return $this->sendError('Voiture is not exist.');
        }
        $voiture = Voiture::findOrFail($id);
        $voiture->update($request->all());
        return $this->sendResponse(new VoitureResource($voiture), 'Voiture Updated Successfully.');
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
}
