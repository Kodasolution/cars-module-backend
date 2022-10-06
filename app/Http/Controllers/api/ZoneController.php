<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ZoneRequestStore;
use App\Http\Requests\ZoneRequestUpdate;
use App\Http\Resources\ZoneResource;
use App\Models\Commune;
use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zone = Zone::all();
        if (sizeof($zone) == 0) {
            return $this->sendError('Zone not found.');
        }
        return $this->sendResponse(ZoneResource::collection($zone), 'fetch is called Successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ZoneRequestStore $request)
    {
        $communeExist = Commune::find($request->commune_id);
        if (is_null($communeExist)) {
            return $this->sendError('commune_id not found.');
        }
        $zone = Zone::create($request->all());
        return $this->sendResponse(new ZoneResource($zone), 'Zone Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $zone = Zone::find($id);
        if (is_null($zone)) {
            return $this->sendError('zone not found.');
        }
        return $this->sendResponse(new ZoneResource($zone), 'zone is fetching Successfully .');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ZoneRequestUpdate $request, $id)
    {
        $zoneExist = Zone::where('id', $id)->exists();
        if ($zoneExist == null) {
            return $this->sendError('Zone is not exist.');
        }
        $communeExist = Commune::find($request->commune_id);
        if (is_null($communeExist)) {
            return $this->sendError('commune_id not found.');
        }
        $zone = Zone::findOrFail($id);
        $zone->update($request->all());
        return $this->sendResponse(new ZoneResource($zone), 'zone updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $zoneExist = Zone::where('id', $id)->exists();
        if ($zoneExist == null) {
            return $this->sendError('Zone is not exist.');
        }
        $zone = Zone::findOrFail($id);
        $zone->delete();
        return $this->sendResponse([], 'Zone Deleted Successfully.');
    }
}
