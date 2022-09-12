<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EntrepriseRequestStore;
use App\Http\Requests\EntrepriseRequestUpdate;
use App\Http\Resources\EntrepriseResource;
use App\Models\Entreprise;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entreprise = Entreprise::all();
        if (sizeof($entreprise) == 0) {
            return $this->sendError('Entreprese not found.');
        }
        return $this->sendResponse(EntrepriseResource::collection($entreprise), 'fetch is called Successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EntrepriseRequestStore $request)
    {
        $entreprise = Entreprise::create($request->all());
        return $this->sendResponse(new EntrepriseResource($entreprise), 'Entreprise Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entreprise = Entreprise::find($id);
        if (is_null($entreprise)) {
            return $this->sendError('Entreprise not found.');
        }
        return $this->sendResponse(new EntrepriseResource($entreprise), 'Entreprise is fetching Successfully .');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EntrepriseRequestUpdate $request, $id)
    {
        $entrepriseExist = Entreprise::where('id', $id)->exists();
        if ($entrepriseExist == null) {
            return $this->sendError('Entreprise is not exist.');
        }
        $entreprise = Entreprise::findOrFail($id);
        $entreprise->update($request->all());
        return $this->sendResponse(new EntrepriseResource($entreprise), 'Entreprise Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $entrepriseExist = Entreprise::where('id', $id)->exists();
        if ($entrepriseExist == null) {
            return $this->sendError('Entreprise is not exist.');
        }
        $entreprise = Entreprise::findOrFail($id);
        $entreprise->delete();
        return $this->sendResponse([], 'Entreprise Deleted Successfully.');
    }
}
