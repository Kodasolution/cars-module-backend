<?php

namespace App\Http\Controllers\api;

use App\Models\TypeSalle;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TypeSalleResource;

class TypeSalleController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeSalle = TypeSalle::all();
        if (sizeof($typeSalle) == 0) {
            return $this->sendError('no found.');
        }
        return $this->sendResponse(TypeSalleResource::collection($typeSalle), 'fetch is called Successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                "type_salle" => "required|unique:type_salles,type_salle",
                "entreprise_id" => "required"
            ]
        );
        $entrepriseExist = Entreprise::find($request->entreprise_id);
        if (is_null($entrepriseExist)) {
            return $this->sendError('entreprise_id not found.');
        }
        $typeSalle = TypeSalle::create($request->all());
        return $this->sendResponse(new TypeSalleResource($typeSalle), 'Type Salle Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $typeSalle = TypeSalle::find($id);
        if (is_null($typeSalle)) {
            return $this->sendError('Type Chambre not found.');
        }
        return $this->sendResponse(new TypeSalleResource($typeSalle), 'Type Salle is fetching Successfully .');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
