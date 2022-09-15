<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaiementHonoraireResource;
use App\Models\PaiementHonoraire;
use Illuminate\Http\Request;

class PaiementHonoraireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paiementHonoraire = PaiementHonoraire::all();
        if (sizeof($paiementHonoraire) == 0) {
            return $this->sendError('Paiement honoraire not found.');
        }
        return $this->sendResponse(PaiementHonoraire::collection($paiementHonoraire), 'fetch is called Successfully.');
  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $paiementHonoraire = PaiementHonoraire::create($request->all());
        return $this->sendResponse(new PaiementHonoraireResource($paiementHonoraire), 'Paiement honoraire Created Successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paiementHonoraire = PaiementHonoraire::find($id);
        if (is_null($paiementHonoraire)) {
            return $this->sendError('paiement honoraire not found.');
        }
        return $this->sendResponse(new PaiementHonoraireResource($paiementHonoraire), 'paiement honoraire is fetching Successfully .');


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
        $paiementHonoraireExist = PaiementHonoraire::where('id', $id)->exists();
        if ($paiementHonoraireExist == null) {
            return $this->sendError('Paiement honoraire is not exist.');
        }
        $paiementHonoraire = PaiementHonoraire::findOrFail($id);
        $paiementHonoraire->update($request->all());
        return $this->sendResponse(new PaiementHonoraireResource($paiementHonoraire), 'Paiement honoraire Updated Successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paiementHonoraireExist = PaiementHonoraire::where('id', $id)->exists();
        if ($paiementHonoraireExist == null) {
            return $this->sendError('Paiement honoraire is not exist.');
        }
        $paiementHonoraire = PaiementHonoraire::findOrFail($id);
        $paiementHonoraire->delete();
        return $this->sendResponse([], 'Paiement honoraire Deleted Successfully.');
    
    }
}
