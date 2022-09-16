<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FactureGlobalResquestUpdate;
use App\Http\Resources\FactureGlobalResource;
use App\Models\FactureGlobal;
use Illuminate\Http\Request;

class FactureGlobalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $factureGlobal = FactureGlobal::all();
        if (sizeof($factureGlobal) == 0) {
            return $this->sendError('Facture global not found.');
        }
        return $this->sendResponse(FactureGlobal::collection($factureGlobal), 'fetch is called Successfully.');
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $factureGlobal = FactureGlobal::create($request->all());
        return $this->sendResponse(new FactureGlobalResource($factureGlobal), 'Facture global Created Successfully.');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $factureGlobal = FactureGlobal::find($id);
        if (is_null($factureGlobal)) {
            return $this->sendError('Facture global not found.');
        }
        return $this->sendResponse(new FactureGlobalResource($factureGlobal), 'Facture global is fetching Successfully .');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FactureGlobalResquestUpdate $request, $id)
    {
        $factureGlobalExist=FactureGlobal::where('id',$id)->exists();
        if ($factureGlobalExist == null) {
            return $this->sendError('Facture global that you want to update is not exist.');
        }
        $factureGlobal = FactureGlobal::findOrFail($id);
        $factureGlobal->update($request->all());
        return $this->sendResponse(new FactureGlobalResource($factureGlobal), 'Facture global Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $factureGlobalExist=FactureGlobal::where('id',$id)->exists();
        if ($factureGlobalExist == null) {
            return $this->sendError('Facture global that you want to delete is not exist.');
        }
        $factureGlobal = FactureGlobal::findOrFail($id);
        $factureGlobal->delete();
        return $this->sendResponse([], 'Facture global Deleted Successfully.');
    
    }
}
