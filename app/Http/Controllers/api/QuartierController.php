<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuartierRequestStore;
use App\Http\Requests\QuartierRequestUpdate;
use App\Http\Resources\QuartierResource;
use App\Models\Quartier;
use App\Models\Zone;
use Illuminate\Http\Request;

class QuartierController extends Controller
{
         /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quartier = Quartier::all();
        if (sizeof($quartier) == 0) {
            return $this->sendError('quartier not found.');
        }
        return $this->sendResponse(QuartierResource::collection($quartier), 'fetch is called Successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuartierRequestStore $request)
    {
        $zoneExist = Zone::find($request->zone_id);
        if (is_null($zoneExist)) {
            return $this->sendError('zone_id not found.');
        }
        $quartier = Quartier::create($request->all());
        return $this->sendResponse(new QuartierResource($quartier), 'quartier Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quartier = Quartier::find($id);
        if (is_null($quartier)) {
            return $this->sendError('quartier not found.');
        }
        return $this->sendResponse(new QuartierResource($quartier), 'quartier is fetching Successfully .');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuartierRequestUpdate $request, $id)
    {
        $quartierExist = Quartier::where('id', $id)->exists();
        if ($quartierExist == null) {
            return $this->sendError('Quartier is not exist.');
        }
        $zoneExist = Zone::find($request->zone_id);
        if (is_null($zoneExist)) {
            return $this->sendError('zone_id not found.');
        }
        $quartier = Quartier::findOrFail($id);
        $quartier->update($request->all());
        return $this->sendResponse(new QuartierResource($quartier), 'quartier updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quartierExist = Quartier::where('id', $id)->exists();
        if ($quartierExist == null) {
            return $this->sendError('Quartier is not exist.');
        }
        $quartier = Quartier::findOrFail($id);
        $quartier->delete();
        return $this->sendResponse([], 'quartier Deleted Successfully.');
    }
}
