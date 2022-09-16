<?php

namespace App\Http\Controllers\api;

use App\Models\Entreprise;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UtilisateurResource;
use App\Http\Requests\UtilisateurResquestStore;
use App\Http\Requests\UtilisateurResquestUpdate;

class UtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $utilisateur = Utilisateur::all();
        if (sizeof($utilisateur) == 0) {
            return $this->sendError('Utilisateur not found.');
        }
        return $this->sendResponse(UtilisateurResource::collection($utilisateur), 'fetch is called Successfully.');
  
   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UtilisateurResquestStore $request)
    {
        $entrepriseExist = Entreprise::find( $request->entreprise_id);
        if(is_null($entrepriseExist)){
            return $this->sendError('entreprise_id not found.');
        }
        $utilisateur = Utilisateur::create($request->all());
        return $this->sendResponse(new UtilisateurResource($utilisateur), 'Utilisateur Created Successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
        $utilisateur= Utilisateur::find($id);
        if (is_null($utilisateur)) {
            return $this->sendError('Utilisateur not found.');
        }
        return $this->sendResponse(new UtilisateurResource($utilisateur), 'Utilisateur is fetching Successfully .');
    
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UtilisateurResquestUpdate $request, $id)
    {
        $utilisateurExist = Utilisateur::where('id', $id)->exists();
        $entrepriseExist = Entreprise::find( $request->entreprise_id);
        if(is_null($entrepriseExist)){
            return $this->sendError('entreprise_id not found.');
        }
        if ($utilisateurExist == null) {
            return $this->sendError('Utilisateur is not exist.');
        }
        $utilisateur = Utilisateur::findOrFail($id);
        $utilisateur->update($request->all());
        return $this->sendResponse(new UtilisateurResource($utilisateur), 'Utilisateur Updated Successfully.');
   
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $utilisateurExist = Utilisateur::where('id', $id)->exists();
        if ($utilisateurExist == null) {
            return $this->sendError('Utilisateur is not exist.');
        }
        $utilisateur = Utilisateur::findOrFail($id);
        $utilisateur->delete();
        return $this->sendResponse([], 'Utilisateur Deleted Successfully.');
   
    }
}
