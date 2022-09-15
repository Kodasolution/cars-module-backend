<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FactureDetailleResquestStore;
use App\Http\Requests\FactureDetailleResquestUpdate;
use App\Http\Resources\FactureDetailleResource;
use App\Models\FactureDetaille;
use Illuminate\Http\Request;

class FactureDetailleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            
        $factureDetaille = FactureDetaille::all();
        if (sizeof($factureDetaille) == 0) {
            return $this->sendError('Facture detaille not found.');
        }
        return $this->sendResponse(FactureDetaille::collection($factureDetaille), 'fetch is called Successfully.');
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FactureDetailleResquestStore $request)
    {
        
        $factureDetaille = FactureDetaille::create($request->all());
        return $this->sendResponse(new FactureDetailleResource($factureDetaille), 'Facture detaille Created Successfully.');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  
           $factureDetaille = FactureDetaille::find($id);
        if (is_null($factureDetaille)) {
            return $this->sendError('Facture detaille not found.');
        }
        return $this->sendResponse(new FactureDetailleResource($factureDetaille), 'Facture detaille is fetching Successfully .');
   }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FactureDetailleResquestUpdate $request, $id)
    {
        
        $factureDetailleExist=FactureDetaille::where('id',$id)->exists();
        if ($factureDetailleExist == null) {
            return $this->sendError('Facture detaille that you want to update is not exist.');
        }
        $factureDetaille = FactureDetaille::findOrFail($id);
        $factureDetaille->update($request->all());
        return $this->sendResponse(new FactureDetailleResource($factureDetaille), 'Facture detaille Updated Successfully.');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $factureDetailleExist=FactureDetaille::where('id',$id)->exists();
        if ($factureDetailleExist == null) {
            return $this->sendError('Facture detaille that you want to delete is not exist.');
        }
        $factureDetaille = FactureDetaille::findOrFail($id);
        $factureDetaille->delete();
        return $this->sendResponse([], 'Facture detaille Deleted Successfully.');
    }
}
