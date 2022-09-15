<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaiementImpotResquestStore;
use App\Http\Requests\PaiementImpotResquestUpdate;
use App\Http\Resources\PaiementImpotResource;
use App\Models\PaiementImpot;
use Illuminate\Http\Request;

class PaiementImpotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paiementImpot = PaiementImpot::all();
        if (sizeof($paiementImpot) == 0) {
            return $this->sendError('Paiement impot not found.');
        }
        return $this->sendResponse(PaiementImpot::collection($paiementImpot), 'fetch is called Successfully.');
  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaiementImpotResquestStore $request)
    {
        $paiementImpot = PaiementImpot::create($request->all());
        return $this->sendResponse(new PaiementImpotResource($paiementImpot), 'Paiement impot Created Successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paiementImpot = PaiementImpot::find($id);
        if (is_null($paiementImpot)) {
            return $this->sendError('paiement impot not found.');
        }
        return $this->sendResponse(new PaiementImpotResource($paiementImpot), 'paiement impot is fetching Successfully .');


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PaiementImpotResquestUpdate $request, $id)
    {
        $paiementImpotExit = PaiementImpot::where('id', $id)->exists();
        if ($paiementImpotExit == null) {
            return $this->sendError('Paiement impot is not exist.');
        }
        $paiementImpot = PaiementImpot::findOrFail($id);
        $paiementImpot->update($request->all());
        return $this->sendResponse(new PaiementImpotResource($paiementImpot), 'Paiement impot Updated Successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $paiementImpotExit = PaiementImpot::where('id', $id)->exists();
        if ($paiementImpotExit == null) {
            return $this->sendError('Paiement Impot is not exist.');
        }
        $paiementImpot = PaiementImpot::findOrFail($id);
        $paiementImpot->delete();
        return $this->sendResponse([], 'Paiement impot Deleted Successfully.');
    
    }
}
