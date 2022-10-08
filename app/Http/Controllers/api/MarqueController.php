<?php

namespace App\Http\Controllers\api;

use App\Models\Marque;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MarqueResource;
use App\Http\Requests\MarqueStoreRequest;
use App\Http\Requests\MarqueRequestUpdate;

class MarqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marque = Marque::all();
        if (sizeof($marque) == 0) {
            return $this->sendError('Marque not found.');
        }
        return $this->sendResponse(MarqueResource::collection($marque), 'fetch is called Successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarqueStoreRequest $request)
    {
        $file = $request->logo_marque->store("MarqueVoitureImages/" . $request->marque, "public");
        $marque = Marque::create([
            'marque' => $request->marque,
            "logo_marque"=> $file
        ]);
        return $this->sendResponse(new MarqueResource($marque), 'Marque Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $marque = Marque::find($id);
        if (is_null($marque)) {
            return $this->sendError('Marque not found.');
        }
        return $this->sendResponse(new MarqueResource($marque), 'Marque is fetching Successfully .');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MarqueRequestUpdate $request, $id)
    {
        $marqueExist=Marque::where('id',$id)->exists();
        if ($marqueExist == null) {
            return $this->sendError('Marque is not exist.');
        }
        $marque = Marque::findOrFail($id);
        $file = $request->logo_marque->store("MarqueVoitureImages/" . $request->marque, "public");
        $marque->update(
            [
                'marque' => $request->marque,
                "logo_marque"=> $file
            ]
        );
        return $this->sendResponse(new MarqueResource($marque), 'Marque Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $marqueExist=Marque::where('id',$id)->exists();
        if ($marqueExist == null) {
            return $this->sendError('Marque is not exist.');
        }
        $marque = Marque::findOrFail($id);
        $marque->delete();
        return $this->sendResponse([], 'Product Deleted Successfully.');
    }

}
