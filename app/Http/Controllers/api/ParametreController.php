<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParametreRequestStore;
use App\Http\Requests\ParametreRequestUpdate;
use App\Http\Resources\ParametreResource;
use App\Models\Parametre;
use Illuminate\Http\Request;

class ParametreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parametre = Parametre::all();
        if (sizeof($parametre) == 0) {
            return $this->sendError('Parametre not found.');
        }
        return $this->sendResponse(ParametreResource::collection($parametre), 'fetch is called Successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParametreRequestStore $request)
    {
        $parametre = Parametre::create($request->all());
        return $this->sendResponse(new ParametreResource($parametre), 'Parametre Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parametre = Parametre::find($id);
        if (is_null($parametre)) {
            return $this->sendError('parametre not found.');
        }
        return $this->sendResponse(new ParametreResource($parametre), 'parametre is fetching Successfully .');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ParametreRequestUpdate $request, $id)
    {
        $parametreExist = Parametre::where('id', $id)->exists();
        if ($parametreExist == null) {
            return $this->sendError('Parametre is not exist.');
        }
        $parametre = Parametre::findOrFail($id);
        $parametre->update($request->all());
        return $this->sendResponse(new ParametreResource($parametre), 'parametre Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $parametreExist = Parametre::where('id', $id)->exists();
        if ($parametreExist == null) {
            return $this->sendError('Parametre is not exist.');
        }
        $parametre = Parametre::findOrFail($id);
        $parametre->delete();
        return $this->sendResponse([], 'Modele Deleted Successfully.');
    }
}
