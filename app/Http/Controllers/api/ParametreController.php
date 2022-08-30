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
        $parametre = Parametre::findOrFail($id);
        $parametre->delete();
        return $this->sendResponse([], 'Modele Deleted Successfully.');
    }
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data' => $result,
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

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
