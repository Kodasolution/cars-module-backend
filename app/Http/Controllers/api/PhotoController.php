<?php

namespace App\Http\Controllers\api;

use App\Models\Photos;
use App\Models\Voiture;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PhotoResquestStore;
use App\Http\Resources\PhotoResource;
use App\Http\Requests\PhotoResquestUpdate;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photo = Photos::all();
        if (sizeof($photo) == 0) {
            return $this->sendError('Photo not found.');
        }
        return $this->sendResponse(PhotoResource::collection($photo), 'fetch is called Successfully.');
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhotoResquestStore $request)
    { 
        $voitureExist = Voiture::find( $request->voiture_id);
        if(is_null($voitureExist)){
               return $this->sendError('voiture_id not found.');
           }
        $photo = Photos::create($request->all());
        return $this->sendResponse(new PhotoResource($photo), 'Photo added Successfully.');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $photo = Photos::find($id);
        if (is_null($photo)) {
            return $this->sendError('Photos not found.');
        }
        return $this->sendResponse(new PhotoResource($photo), 'Photos is fetching Successfully .');
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PhotoResquestUpdate $request, $id)
    {
        $photoExist=Photos::where('id',$id)->exists();
        $voitureExist = Voiture::find( $request->voiture_id);
        if(is_null($voitureExist)){
               return $this->sendError('voiture_id not found.');
           }
        if ($photoExist == null) {
            return $this->sendError('Photos that you want to update is not exist.');
        }
        $photo = Photos::findOrFail($id);
        $photo->update($request->all());
        return $this->sendResponse(new PhotoResource($photo), 'Photo Updated Successfully.');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo=Photos::where('id',$id)->exists();
        if ($photo == null) {
            return $this->sendError('Photo that you want to delete is not exist.');
        }
        $photo = Photos::findOrFail($id);
        $photo->delete();
        return $this->sendResponse([], 'Photo Deleted Successfully.');
    
    }
}
