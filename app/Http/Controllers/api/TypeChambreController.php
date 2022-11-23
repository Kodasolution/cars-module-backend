<?php

namespace App\Http\Controllers\api;

use App\Models\TypeChambres;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TypeChambreresource;
use App\Models\Entreprise;
use Illuminate\Support\Facades\Auth;

class TypeChambreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeChambre = TypeChambres::all();
        if (sizeof($typeChambre) == 0) {
            return $this->sendError('no found.');
        }
        return $this->sendResponse(TypeChambreresource::collection($typeChambre), 'fetch is called Successfully.');
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
                "type_chambre" => "required|unique:type_chambres,type_chambre",
                "entreprise_id" => "required"
            ]
        );
        $entrepriseExist = Entreprise::find($request->entreprise_id);
        if (is_null($entrepriseExist)) {
            return $this->sendError('entreprise_id not found.');
        }
        $typeChambre = TypeChambres::create($request->all());
        return $this->sendResponse(new TypeChambreresource($typeChambre), 'Type Chambre Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $typeChambre = TypeChambres::find($id);
        if (is_null($typeChambre)) {
            return $this->sendError('Type Chambre not found.');
        }
        return $this->sendResponse(new TypeChambreresource($typeChambre), 'Type Chambre is fetching Successfully .');
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
