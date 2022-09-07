<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProvinceRequestStore;
use App\Http\Requests\ProvinceRequestupdate;
use App\Http\Resources\ProvinceResource;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $province = Province::all();
        if (sizeof($province) == 0) {
            return $this->sendError('Province not found.');
        }
        return $this->sendResponse(ProvinceResource::collection($province), 'fetch is called Successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProvinceRequestStore $request)
    {
        $province = Province::create($request->all());
        return $this->sendResponse(new ProvinceResource($province), 'Province Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $province = Province::find($id);
        if (is_null($province)) {
            return $this->sendError('Entreprise not found.');
        }
        return $this->sendResponse(new ProvinceResource($province), 'Province is fetching Successfully .');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProvinceRequestupdate $request, $id)
    {
        $provinceExist = Province::where('id', $id)->exists();
        if ($provinceExist == null) {
            return $this->sendError('Province is not exist.');
        }
        $province = Province::findOrFail($id);
        $province->update($request->all());
        return $this->sendResponse(new ProvinceResource($province), 'Province Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provinceExist = Province::where('id', $id)->exists();
        if ($provinceExist == null) {
            return $this->sendError('Province is not exist.');
        }
        $province = Province::findOrFail($id);
        $province->delete();
        return $this->sendResponse([], 'Province Deleted Successfully.');
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
