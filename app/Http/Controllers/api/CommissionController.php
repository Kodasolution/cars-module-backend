<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommissionResource;
use App\Models\Commission;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commission = Commission::all();
        if (sizeof($commission) == 0) {
            return $this->sendError('Commission not found.');
        }
        return $this->sendResponse(CommissionResource::collection($commission), 'fetch is called Successfully.');
  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $commission = Commission::create($request->all());
        return $this->sendResponse(new CommissionResource($commission), 'Commission Created Successfully.');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $commission= Commission::find($id);
        if (is_null($commission)) {
            return $this->sendError('Commission not found.');
        }
        return $this->sendResponse(new CommissionResource($commission), 'Commission is fetching Successfully .');
    
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
        $commissionExist = Commission::where('id', $id)->exists();
        if ($commissionExist == null) {
            return $this->sendError('Commission is not exist.');
        }
        $commission = Commission::findOrFail($id);
        $commission->update($request->all());
        return $this->sendResponse(new CommissionResource($commission), 'Commission Updated Successfully.');
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $commissionExist = Commission::where('id', $id)->exists();
        if ($commissionExist == null) {
            return $this->sendError('Commision is not exist.');
        }
        $commission = Commission::findOrFail($id);
        $commission->delete();
        return $this->sendResponse([], 'Commission Deleted Successfully.');
   
    }
}
