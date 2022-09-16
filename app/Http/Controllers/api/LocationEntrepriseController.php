<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationEntrepriseResquestStore;
use App\Http\Requests\LocationEntrepriseResquestUpdate;
use App\Http\Resources\LocationEntrepriseResource;
use App\Models\LocationEntreprise;
use Illuminate\Http\Request;

class LocationEntrepriseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locationEntreprise = LocationEntreprise::all();
        if (sizeof($locationEntreprise) == 0) {
            return $this->sendError('Location Entriprise not found.');
        }
        return $this->sendResponse(LocationEntrepriseResource::collection($locationEntreprise), 'fetch is called Successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationEntrepriseResquestStore $request)
    {
        $locationEntreprise = LocationEntreprise::create($request->all());
        // return $marque;
        return $this->sendResponse(new LocationEntrepriseResource($locationEntreprise), 'Location Created Successfully.');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
        $locationEntreprise = LocationEntreprise::find($id);
        if (is_null($locationEntreprise)) {
            return $this->sendError('Location Entreprise not found.');
        }
        return $this->sendResponse(new LocationEntrepriseResource($locationEntreprise), 'Location is fetching Successfully .');
   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocationEntrepriseResquestUpdate $request, $id)
    {
        $locationEntrepriseExist=LocationEntreprise::where('id',$id)->exists();
        if ($locationEntrepriseExist == null) {
            return $this->sendError('Location is not exist.');
        }
        $locationEntreprise = LocationEntreprise::findOrFail($id);
        $locationEntreprise->update($request->all());
        return $this->sendResponse(new LocationEntrepriseResource($locationEntreprise), 'Location Updated Successfully.');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $locationEntrepriseExist=LocationEntreprise::where('id',$id)->exists();
        if ($locationEntrepriseExist == null) {
            return $this->sendError('Location Entreprise is not exist.');
        }
        $locationEntreprise = LocationEntreprise::findOrFail($id);
        $locationEntreprise->delete();
        return $this->sendResponse([], 'Location Entreprise Deleted Successfully.');
    
    }
}
