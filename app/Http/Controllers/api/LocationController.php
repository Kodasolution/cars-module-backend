<?php

namespace App\Http\Controllers\api;

use App\Models\Client;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;
use App\Http\Requests\LocationRequestStore;
use App\Http\Requests\LocationRequestUpdate;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $location = Location::all();
        if (sizeof($location) == 0) {
            return $this->sendError('Location not found.');
        }
        return $this->sendResponse(LocationResource::collection($location), 'fetch is called Successfully.');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationRequestStore $request)
    {
        $clientExist = Client::find($request->client_id);
        if (is_null($clientExist)) {
            return $this->sendError('client_id not found.');
        }
        $location = Location::create(
            [
                "date_location" => $request->date_location,
                "montant_total" => $request->montant_total,
                "client_id"=>$request->client_id
            ]
        );
        $location_id = DB::getPdo()->lastInsertId();
        

        return $this->sendResponse(new LocationResource($location), 'Location Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location = Location::find($id);
        if (is_null($location)) {
            return $this->sendError('Location not found.');
        }
        return $this->sendResponse(new LocationResource($location), 'Location is fetching Successfully .');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocationRequestUpdate $request, $id)
    {
        $locationExist = Location::where('id', $id)->exists();
        $clienttExist = Client::find($request->client_id);
        if (is_null($clienttExist)) {
            return $this->sendError('client_id not found.');
        }
        if ($locationExist == null) {
            return $this->sendError('Location is not exist.');
        }
        $location = Location::findOrFail($id);
        $location->update($request->all());
        return $this->sendResponse(new LocationResource($location), 'Location Updated Successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $locationExist = Location::where('id', $id)->exists();
        if ($locationExist == null) {
            return $this->sendError('Location is not exist.');
        }
        $location = Location::findOrFail($id);
        $location->delete();
        return $this->sendResponse([], 'Location Deleted Successfully.');

    }
}
