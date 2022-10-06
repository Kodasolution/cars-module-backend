<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdminResource;
use App\Http\Resources\ClientResource;
use App\Http\Requests\ClientRequestStore;
use App\Http\Requests\ClientRequestUpdate;

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
    // public function store(ClientRequestStore $request)
    // {
    //     $userExist = User::find( $request->user_id);
    //     if(is_null($userExist)){
    //         return $this->sendError('user_id not found.');
    //     }
    //     $user=User::where('id',$request->user_id)->first();
    //     $clientExist= Client::where('user_id',$user->id)->first();
    //     if($clientExist){
    //         return $this->sendError('client is already exist.');
    //     }
    //     if($user->role !== "client" ){
    //         return $this->sendError("this user is not client");
    //     }
    //     $client = Client::create($request->all());
    //     return $this->sendResponse(new ClientResource($client), 'Client Created Successfully.');
    // }

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
    // public function update(ClientRequestUpdate $request, $id)
    // {
    //     $clientExist = Client::where('id', $id)->exists();
    //     if ($clientExist == null) {
    //         return $this->sendError('Client is not exist.');
    //     }    
    //     $user=User::where('id',$request->user_id)->first();
    //     if($user->role !== "client" ){
    //                return $this->sendError("this user is not client");
    //            }
    //     $client = Client::findOrFail($id);
    //     $client->update($request->all());
    //     return $this->sendResponse(new ClientResource($client), 'Client Updated Successfully.');
   
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $clientExist = Client::where('id', $id)->exists();
    //     if ($clientExist == null) {
    //         return $this->sendError('Client is not exist.');
    //     }
    //     $client = Client::findOrFail($id);
    //     $client->delete();
    //     return $this->sendResponse([], 'Client Deleted Successfully.');
    // }
}
