<?php

namespace App\Http\Controllers\api;

use App\Models\Modele;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ModeleRequestStore;
use App\Http\Requests\ModeleRequestUpdate;
use App\Http\Resources\ModeleResource;
use Illuminate\Database\Eloquent\Model;

class ModeleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modele = Modele::all();
        return $this->sendResponse(ModeleResource::collection($modele), 'fetch is called Successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModeleRequestStore $request)
    {
        $modele = Modele::create($request->all());
        return $this->sendResponse(new ModeleResource($modele), 'Modele Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $modele = Modele::find($id);
        if (is_null($modele)) {
            return $this->sendError('Model not found.');
        }
        return $this->sendResponse(new ModeleResource($modele), 'Modele is fetching Successfully .');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModeleRequestUpdate $request, $id)
    {
        $modele = Modele::findOrFail($id);
        $modele->update($request->all());
        return $this->sendResponse(new ModeleResource($modele), 'Modele Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modele = Modele::findOrFail($id);
        $modele->delete();
        return $this->sendResponse([], 'Modele Deleted Successfully.');
    }
    public function sendResponse($result, $message)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        
        return response()->json($response, $code);
    }
}
