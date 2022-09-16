<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequestStore;
use App\Http\Requests\ClientRequestUpdate;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = Client::all();
        if (sizeof($client) == 0) {
            return $this->sendError('Client not found.');
        }
        return $this->sendResponse(ClientResource::collection($client), 'fetch is called Successfully.');
  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequestStore $request)
    {
        $client = Client::create($request->all());
        return $this->sendResponse(new ClientResource($client), 'Client Created Successfully.');
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client= Client::find($id);
        if (is_null($client)) {
            return $this->sendError('Client not found.');
        }
        return $this->sendResponse(new ClientResource($client), 'Client is fetching Successfully .');
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequestUpdate $request, $id)
    {
        $clientExist = Client::where('id', $id)->exists();
        if ($clientExist == null) {
            return $this->sendError('Client is not exist.');
        }
        $client = Client::findOrFail($id);
        $client->update($request->all());
        return $this->sendResponse(new ClientResource($client), 'Client Updated Successfully.');
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clientExist = Client::where('id', $id)->exists();
        if ($clientExist == null) {
            return $this->sendError('Client is not exist.');
        }
        $client = Client::findOrFail($id);
        $client->delete();
        return $this->sendResponse([], 'Client Deleted Successfully.');
    }
}
