<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdresseRequestStore;
use App\Http\Resources\AdresseResource;
use App\Models\Adresse;
use Illuminate\Http\Request;

class AdresseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adresse = Adresse::all();
        if (sizeof($adresse) == 0) {
            return $this->sendError('Adresse not found.');
        }
        return $this->sendResponse(AdresseResource::collection($adresse), 'fetch is called Successfully.');
  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdresseRequestStore $request)
    {
        $adresse = Adresse::create($request->all());
        return $this->sendResponse(new AdresseResource($adresse), 'Adresse Created Successfully.');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $adresse = Adresse::find($id);
        if (is_null($adresse)) {
            return $this->sendError('Adresse not found.');
        }
        return $this->sendResponse(new AdresseResource($adresse), 'Adresse is fetching Successfully .');
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
        $adresseExist = Adresse::where('id', $id)->exists();
        if ($adresseExist == null) {
            return $this->sendError('Adresse is not exist.');
        }
        $adresse = Adresse::findOrFail($id);
        $adresse->update($request->all());
        return $this->sendResponse(new AdresseResource($adresse), 'Adresse Updated Successfully.');
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $adresseExist = Adresse::where('id', $id)->exists();
        if ($adresseExist == null) {
            return $this->sendError('Adresse is not exist.');
        }
        $adresse = Adresse::findOrFail($id);
        $adresse->delete();
        return $this->sendResponse([], 'Adresse Deleted Successfully.');
    }
}
