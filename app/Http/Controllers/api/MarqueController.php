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
        $marque = Marque::create($request->all());
        // return $marque;
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
        $marque->update($request->all());
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