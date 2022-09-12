<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EquipementStoreRequest;
use App\Http\Resources\EquipementResource;
use App\Models\Equipement;
use Illuminate\Http\Request;

class EquipementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipement = Equipement::all();
        if (sizeof($equipement) == 0) {
            return $this->sendError('Equipement not found.');
        }
        return $this->sendResponse(EquipementResource::collection($equipement), 'fetch is called Successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EquipementStoreRequest $request)
    {
        $equipement = Equipement::create($request->all());
        return $this->sendResponse(new EquipementResource($equipement), 'Equipement Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $equipement = Equipement::find($id);
        if (is_null($equipement)) {
            return $this->sendError('Equipement not found.');
        }
        return $this->sendResponse(new EquipementResource($equipement), 'Equipement is fetching Successfully .');
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
        $equipementExist=Equipement::where('id',$id)->exists();
        if ($equipementExist == null) {
            return $this->sendError('Equipement that you want to update is not exist.');
        }
        $equipement = Equipement::findOrFail($id);
        $equipement->update($request->all());
        return $this->sendResponse(new EquipementResource($equipement), 'Equipement Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $equipementExist=Equipement::where('id',$id)->exists();
        if ($equipementExist == null) {
            return $this->sendError('Equipement that you want to delete is not exist.');
        }
        $equipement = Equipement::findOrFail($id);
        $equipement->delete();
        return $this->sendResponse([], 'Equipement Deleted Successfully.');
    }

}
