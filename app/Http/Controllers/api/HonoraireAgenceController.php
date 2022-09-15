<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\HonoraireAgenceResquestStore;
use App\Http\Requests\HonoraireAgenceResquestUpdate;
use App\Http\Resources\HonoraireAgenceResource;
use App\Models\HonoraireAgence;
use Illuminate\Http\Request;

class HonoraireAgenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $honoraireAgence = HonoraireAgence::all();
        if (sizeof($honoraireAgence) == 0) {
            return $this->sendError('Honoraire agence not found.');
        }
        return $this->sendResponse(HonoraireAgenceResource::collection($honoraireAgence), 'fetch is called Successfully.');
  
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HonoraireAgenceResquestStore $request)
    {
        $honoraireAgence = HonoraireAgence::create($request->all());
        return $this->sendResponse(new HonoraireAgenceResource($honoraireAgence), 'Honoraire agence Created Successfully.');
  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $honoraireAgence= HonoraireAgence::find($id);
        if (is_null($honoraireAgence)) {
            return $this->sendError('Honoraire agence not found.');
        }
        return $this->sendResponse(new HonoraireAgenceResource($honoraireAgence), 'Honoraire Agence is fetching Successfully .');
   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HonoraireAgenceResquestUpdate $request, $id)
    {   
             $honoraireAgenceExist = HonoraireAgence::where('id', $id)->exists();
        if ($honoraireAgenceExist == null) {
            return $this->sendError('Honoraire agence is not exist.');
        }
        $honoraireAgence = HonoraireAgence::findOrFail($id);
        $honoraireAgence->update($request->all());
        return $this->sendResponse(new HonoraireAgenceResource($honoraireAgence), 'Honoraire agence Updated Successfully.');
  
 }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $honoraireAgenceExist = HonoraireAgence::where('id', $id)->exists();
        if ($honoraireAgenceExist == null) {
            return $this->sendError('Honoraire agence is not exist.');
        }
        $honoraireAgence = HonoraireAgence::findOrFail($id);
        $honoraireAgence->delete();
        return $this->sendResponse([], 'Honoraire agence Deleted Successfully.');
    }
}
