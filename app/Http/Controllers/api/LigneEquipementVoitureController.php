<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LigneEquipementsVoitureResquestUpdate;
use App\Http\Requests\LigneLocationVoitureResquestStore;
use App\Http\Resources\LigneEquipementVoitureResource;
use App\Models\LigneEquipementsVoiture;
use Illuminate\Http\Request;

class LigneEquipementVoitureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ligneEquipementVoiture = LigneEquipementsVoiture::all();
        if (sizeof($ligneEquipementVoiture) == 0) {
            return $this->sendError('Ligne equipement voiture not found.');
        }
        return $this->sendResponse(LigneEquipementVoitureResource::collection($ligneEquipementVoiture), 'fetch is called Successfully.');
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LigneLocationVoitureResquestStore $request)
    {
        $ligneEquipementVoiture = LigneEquipementsVoiture::create($request->all());
        return $this->sendResponse(new LigneEquipementVoitureResource($ligneEquipementVoiture), 'Ligne Equipement Created Successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $ligneEquipementVoiture = LigneEquipementsVoiture::find($id);
        if (is_null($ligneEquipementVoiture)) {
            return $this->sendError('Ligne Equipement voiture not found.');
        }
        return $this->sendResponse(new LigneEquipementVoitureResource($ligneEquipementVoiture), 'Ligne Equipement voiture is fetching Successfully .');

    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LigneEquipementsVoitureResquestUpdate $request, $id)
    {
        $ligneEquipementVoitureExist=LigneEquipementsVoiture::where('id',$id)->exists();
        if ($ligneEquipementVoitureExist == null) {
            return $this->sendError('Ligne equipement voiture that you want to update is not exist.');
        }
        $ligneEquipementVoiture = LigneEquipementsVoiture::findOrFail($id);
        $ligneEquipementVoiture->update($request->all());
        return $this->sendResponse(new LigneEquipementVoitureResource($ligneEquipementVoiture), 'Ligne Equipement voiture Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ligneEquipementVoitureExist=LigneEquipementsVoiture::where('id',$id)->exists();
        if ($ligneEquipementVoitureExist == null) {
            return $this->sendError('Ligne equipement voiture that you want to delete is not exist.');
        }
        $ligneEquipementVoiture = LigneEquipementsVoiture::findOrFail($id);
        $ligneEquipementVoiture->delete();
        return $this->sendResponse([], 'Ligne equipement voiture Deleted Successfully.');
   
    }
}
