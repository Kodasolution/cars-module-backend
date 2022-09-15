<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImpotResquestStore;
use App\Http\Resources\ImpotResource;
use App\Models\Impot;
use Illuminate\Http\Request;

class ImpotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $impot = Impot::all();
        if (sizeof($impot) == 0) {
            return $this->sendError('Impot not found.');
        }
        return $this->sendResponse(ImpotResource::collection($impot), 'fetch is called Successfully.');
  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImpotResquestStore $request)
    {
        $impot = Impot::create($request->all());
        return $this->sendResponse(new ImpotResource($impot), 'Impot Created Successfully.');
  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $impot= Impot::find($id);
        if (is_null($impot)) {
            return $this->sendError('Impot not found.');
        }
        return $this->sendResponse(new ImpotResource($impot), 'Impot is fetching Successfully .');
    
  
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
        $impotExist = Impot::where('id', $id)->exists();
        if ($impotExist == null) {
            return $this->sendError('Impot is not exist.');
        }
        $impot = Impot::findOrFail($id);
        $impot->update($request->all());
        return $this->sendResponse(new ImpotResource($impot), 'Impot Updated Successfully.');
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
         $impotExist = Impot::where('id', $id)->exists();
        if ($impotExist == null) {
            return $this->sendError('Impot is not exist.');
        }
        $impot = Impot::findOrFail($id);
        $impot->delete();
        return $this->sendResponse([], 'Impot Deleted Successfully.');
    }
}
