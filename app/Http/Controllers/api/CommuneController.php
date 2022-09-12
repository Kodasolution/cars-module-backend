<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommuneRequestStore;
use App\Http\Resources\CommuneByProvinceResource;
use App\Http\Resources\CommuneResource;
use App\Models\Commune;
use Illuminate\Http\Request;

class CommuneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commune = Commune::all();
        if (sizeof($commune) == 0) {
            return $this->sendError('Province not found.');
        }
        return $this->sendResponse(CommuneByProvinceResource::collection($commune), 'fetch is called Successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommuneRequestStore $request)
    {
        $commune = Commune::create($request->all());
        return $this->sendResponse(new CommuneByProvinceResource($commune), 'Commune Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $commune = Commune::find($id);
        if (is_null($commune)) {
            return $this->sendError('Commune not found.');
        }
        return $this->sendResponse(new CommuneByProvinceResource($commune), 'Commune is fetching Successfully .');
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
        $communeExist = Commune::where('id', $id)->exists();
        if ($communeExist == null) {
            return $this->sendError('Commune is not exist.');
        }
        $commune = Commune::findOrFail($id);
        $commune->update($request->all());
        return $this->sendResponse(new CommuneByProvinceResource($commune), 'Commune Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $communeExist = Commune::where('id', $id)->exists();
        if ($communeExist == null) {
            return $this->sendError('Commune is not exist.');
        }
        $commune = Commune::findOrFail($id);
        $commune->delete();
        return $this->sendResponse([], 'Commune Deleted Successfully.');
    }
}
