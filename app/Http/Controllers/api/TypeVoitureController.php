<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypeRequestUpdate;
use App\Http\Resources\TypeVoitureResource;
use App\Models\TypeVoiture;
use Illuminate\Http\Request;

class TypeVoitureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = TypeVoiture::all();
        if (sizeof($type) == 0) {
            return $this->sendError('Type not found.');
        }
        return $this->sendResponse(TypeVoitureResource::collection($type), 'fetch is called Successfully.');
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
                "type" => "required|unique:type_voitures,type",
                "photo_type_voiture" => 'required|file',
            ]
        );
        $file = $request->photo_type_voiture->store("TypeVoitureImages/" . $request->type, "public");
        $type = TypeVoiture::create([
            'type' => $request->type,
            'photo_type_voiture' => $file,
        ]);
        return $this->sendResponse(new TypeVoitureResource($type), 'Type Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $type = TypeVoiture::find($id);
        if (is_null($type)) {
            return $this->sendError('Type not found.');
        }
        return $this->sendResponse(new TypeVoitureResource($type), 'Type is fetching Successfully .');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TypeRequestUpdate $request, $id)
    {
        $typeExist = TypeVoiture::where('id', $id)->exists();
        if ($typeExist == null) {
            return $this->sendError('Type is not exist.');
        }
        $type = TypeVoiture::findOrFail($id);
        $file = $request->photo_type_voiture->store("TypeVoitureImages/" . $request->type, "public");
        $type->update([
            'type' => $request->type,
            'photo_type_voiture' => $file,
        ]);
        return $this->sendResponse(new TypeVoitureResource($type), 'Type Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $typeExist = TypeVoiture::where('id', $id)->exists();
        if ($typeExist == null) {
            return $this->sendError('Type is not exist.');
        }
        $type = TypeVoiture::findOrFail($id);
        $type->delete();
        return $this->sendResponse([], 'type Deleted Successfully.');
    }
}
