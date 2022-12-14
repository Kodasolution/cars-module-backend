<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EntrepriseRequestStore;
use App\Http\Requests\EntrepriseRequestUpdate;
use App\Http\Resources\EntrepriseDetailResource;
use App\Http\Resources\EntrepriseResource;
use App\Models\Adresse;
use App\Models\Entreprise;
use App\Models\Quartier;
use Hamcrest\Type\IsBoolean;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entreprise = Entreprise::all();
        if (sizeof($entreprise) == 0) {
            return $this->sendError('Entreprese not found.');
        }
        return $this->sendResponse(EntrepriseResource::collection($entreprise), 'fetch is called Successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EntrepriseRequestStore $request)
    {
        $adressExist = Quartier::find( $request->quartier_id);
        if(is_null($adressExist)){
            return $this->sendError('quartier_id not found.');
        }
        if($request->logo_entreprise !== null){
            $file = $request->logo_entreprise->store("logo" , "public");
            // return $file;
            $entreprise = Entreprise::create([
                "nom_entreprise"=>$request->nom_entreprise,
                "email_entreprise"=>$request->email_entreprise,
                "telephone_entreprise"=>$request->telephone_entreprise,
                "logo_entreprise"=>$file,
                "quartier_id"=>$request->quartier_id,
                "nif_entreprise"=>$request->nif_entreprise,
                "type_entreprise"=>$request->type_entreprise,
                "actif"=>$request->actif,
                "rue"=>$request->rue
            ]);
        }
        $entreprise = Entreprise::create($request->all());
        return $this->sendResponse(new EntrepriseResource($entreprise), 'Entreprise Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entreprise = Entreprise::find($id);
        if (is_null($entreprise)) {
            return $this->sendError('Entreprise not found.');
        }
        return $this->sendResponse(new EntrepriseResource($entreprise), 'Entreprise is fetching Successfully .');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EntrepriseRequestUpdate $request, $id)
    {
        $entrepriseExist = Entreprise::where('id', $id)->exists();
        if ($entrepriseExist == null) {
            return $this->sendError('Entreprise is not exist.');
        }
        $adressExist = Quartier::find( $request->quartier_id);
        if(is_null($adressExist)){
            return $this->sendError('quartier_id not found.');
        }
        $entreprise = Entreprise::findOrFail($id);
        if($request->logo_entreprise !== null){
            $file = $request->logo_entreprise->store("logo" , "public");
            // return $file;
            $entreprise->update([
                "nom_entreprise"=>$request->nom_entreprise,
                "email_entreprise"=>$request->email_entreprise,
                "telephone_entreprise"=>$request->telephone_entreprise,
                "logo_entreprise"=>$file,
                "quartier_id"=>$request->quartier_id,
                "nif_entreprise"=>$request->nif_entreprise,
                "type_entreprise"=>$request->type_entreprise,
                "actif"=>$request->actif,
                "rue"=>$request->rue
            ]);
        }
        $entreprise->update($request->all());
        return $this->sendResponse(new EntrepriseResource($entreprise), 'Entreprise Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $entrepriseExist = Entreprise::where('id', $id)->exists();
        if ($entrepriseExist == null) {
            return $this->sendError('Entreprise is not exist.');
        }
        $entreprise = Entreprise::findOrFail($id);
        $entreprise->delete();
        return $this->sendResponse([], 'Entreprise Deleted Successfully.');
    }
    public function changeStatusEntreprise(Request $request,$id)
    {
        $request->validate([
            "actif"=>"required|boolean"
        ]);
        $entreprise=Entreprise::findOrFail($id);
        $entreprise->update([
            "actif"=>$request->actif
        ]);
        return $this->sendResponse(new EntrepriseResource($entreprise),'Entreprise status is changed');
    }
    public function EntrepriseByStatus($status)
    {
        // return $entreprise;
        if($status == 1 || $status == 0){
            $entreprise=Entreprise::where("actif",$status)->get();
            return $this->sendResponse(EntrepriseResource::collection($entreprise),"entreprise is fetch successfully");

        }else{
            return $this->sendResponse([], 'Status must be boolean value.');
        }
    }

    public function DetailEntreprise()
    {
        $entreprise = Entreprise::all();
        if (sizeof($entreprise) == 0) {
            return $this->sendError('Entreprese not found.');
        }
        return $this->sendResponse(EntrepriseDetailResource::collection($entreprise), 'fetch is called Successfully.');
    }
    public function DetailOneEntreprise($id)
    {
        $entrepriseExist = Entreprise::where('id', $id)->exists();        
        if ($entrepriseExist == null) {
            return $this->sendError('Entreprise is not exist.');
        }
        $entreprise = Entreprise::findOrFail($id);
        return $this->sendResponse(new EntrepriseDetailResource($entreprise), 'fetch is called Successfully.');

    }
}
