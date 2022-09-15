<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LigneLocationVoitureResquestStore;
use App\Http\Requests\LigneLocationVoitureResquestUpdate;
use App\Http\Resources\LigneLocationVoitureResource;
use App\Models\LigneLocationVoiture;
use Illuminate\Http\Request;

class LigneLocationVoitureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ligneLocationVoiture = LigneLocationVoiture::all();
        if (sizeof($ligneLocationVoiture) == 0) {
            return $this->sendError('Ligne equipement voiture not found.');
        }
        return $this->sendResponse(LigneLocationVoitureResource::collection($ligneLocationVoiture), 'fetch is called Successfully.');
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LigneLocationVoitureResquestStore $request)
    {
        $ligneLocationVoiture = LigneLocationVoiture::create($request->all());
        return $this->sendResponse(new LigneLocationVoitureResource($ligneLocationVoiture), 'Ligne voiture location Created Successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ligneLocationVoiture = LigneLocationVoiture::find($id);
        if (is_null($ligneLocationVoiture)) {
            return $this->sendError('Ligne location voiture not found.');
        }
        return $this->sendResponse(new LigneLocationVoitureResource($ligneLocationVoiture), 'Ligne Location voiture is fetching Successfully .');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LigneLocationVoitureResquestUpdate $request, $id)
    {
        $ligneLocationVoitureExist=LigneLocationVoiture::where('id',$id)->exists();
        if ($ligneLocationVoitureExist == null) {
            return $this->sendError('Ligne location voiture that you want to update is not exist.');
        }
        $ligneLocationVoiture = LigneLocationVoiture::findOrFail($id);
        $ligneLocationVoiture->update($request->all());
        return $this->sendResponse(new LigneLocationVoitureResource($ligneLocationVoiture), 'Ligne location voiture Updated Successfully.');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ligneLocationVoitureExist=LigneLocationVoiture::where('id',$id)->exists();
        if ($ligneLocationVoitureExist == null) {
            return $this->sendError('Ligne location voiture that you want to delete is not exist.');
        }
        $ligneLocationVoiture = LigneLocationVoiture::findOrFail($id);
        $ligneLocationVoiture->delete();
        return $this->sendResponse([], 'Ligne location voiture Deleted Successfully.');
   
    }
}
