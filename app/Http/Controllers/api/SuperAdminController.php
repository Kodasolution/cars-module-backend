<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdminRequestStore;
use App\Http\Requests\SuperAdminRequestUpdate;
use App\Http\Resources\SuperAdminResource;
use App\Models\SuperAdmin;
use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $super_admin = SuperAdmin::all();
        if (sizeof($super_admin) == 0) {
            return $this->sendError('super admin not found.');
        }
        return $this->sendResponse(SuperAdminResource::collection($super_admin), 'fetch is called Successfully.');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SuperAdminRequestStore $request)
    {
        $userExist = User::find($request->user_id);
        if (is_null($userExist)) {
            return $this->sendError('user_id not found.');
        }
        $user = User::where('id', $request->user_id)->first();
        $superAdminExist = SuperAdmin::where('user_id', $user->id)->first();
        if ($superAdminExist) {
            return $this->sendError('super admin is already exist.');
        }
        if ($user->role !== "super_admin") {
            return $this->sendError("this user is not super admin");
        }
        $super_admin = SuperAdmin::create($request->all());
        return $this->sendResponse(new SuperAdminResource($super_admin), 'admin Created Successfully.');}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $super_admin = SuperAdmin::find($id);
        if (is_null($super_admin)) {
            return $this->sendError('super admin not found.');
        }
        return $this->sendResponse(new SuperAdminResource($super_admin), 'Super Admin is fetching Successfully .');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SuperAdminRequestUpdate $request, $id)
    {
        $superAdminExist = SuperAdmin::where('id', $id)->exists();
        if ($superAdminExist == null) {
            return $this->sendError('super admin is not exist.');
        }
        $user = User::where('id', $request->user_id)->first();
        if ($user->role !== "super_admin") {
            return $this->sendError("this user is not client");
        }
        $super_admin = SuperAdmin::findOrFail($id);
        $super_admin->update($request->all());
        return $this->sendResponse(new SuperAdminResource($super_admin), 'super admin Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $superAdminExist = SuperAdmin::where('id', $id)->exists();
        if ($superAdminExist == null) {
            return $this->sendError('super admin is not exist.');
        }
        $super_admin = SuperAdmin::findOrFail($id);
        $super_admin->delete();
        return $this->sendResponse([], 'super admin Deleted Successfully.');
    }
}
