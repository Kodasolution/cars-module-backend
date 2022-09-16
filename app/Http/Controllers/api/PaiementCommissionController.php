<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaiementCommissionResquestStore;
use App\Http\Requests\PaiementCommissionResquestUpdate;
use App\Http\Resources\PaiementCommissionResource;
use App\Models\PaiementCommission;
use Illuminate\Http\Request;

class PaiementCommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paiementCommission = PaiementCommission::all();
        if (sizeof($paiementCommission) == 0) {
            return $this->sendError('Paiement commission not found.');
        }
        return $this->sendResponse(PaiementCommission::collection($paiementCommission), 'fetch is called Successfully.');
  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaiementCommissionResquestStore $request)
    {
        
        $paiementCommission = PaiementCommission::create($request->all());
        return $this->sendResponse(new PaiementCommissionResource($paiementCommission), 'Paiement commission Created Successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paiementCommission = PaiementCommission::find($id);
        if (is_null($paiementCommission)) {
            return $this->sendError('paiement commission not found.');
        }
        return $this->sendResponse(new PaiementCommissionResource($paiementCommission), 'paiement commission is fetching Successfully .');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PaiementCommissionResquestUpdate $request, $id)
    {
        $paiementCommissionExist = PaiementCommission::where('id', $id)->exists();
        if ($paiementCommissionExist == null) {
            return $this->sendError('Paiement commission is not exist.');
        }
        $paiementCommission = PaiementCommission::findOrFail($id);
        $paiementCommission->update($request->all());
        return $this->sendResponse(new PaiementCommissionResource($paiementCommission), 'Paiement commission Updated Successfully.');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paiementCommissionExist = PaiementCommission::where('id', $id)->exists();
        if ($paiementCommissionExist == null) {
            return $this->sendError('Paiement Commission is not exist.');
        }
        $paiementCommission = PaiementCommission::findOrFail($id);
        $paiementCommission->delete();
        return $this->sendResponse([], 'Paiement commission Deleted Successfully.');
    
    }
}
