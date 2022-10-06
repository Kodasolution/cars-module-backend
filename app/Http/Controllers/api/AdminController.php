<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequestStore;
use App\Http\Requests\AdminRequestUpdate;
use App\Http\Resources\AdminResource;
use App\Models\Admin;
use App\Models\Entreprise;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = Admin::all();
        if (sizeof($admin) == 0) {
            return $this->sendError('Admin not found.');
        }
        return $this->sendResponse(AdminResource::collection($admin), 'fetch is called Successfully.');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(AdminRequestStore $request)
    // {
    //     $userExist = User::find($request->user_id);
    //     $entrepriseExist = Entreprise::find($request->entreprise_id);
    //     if (is_null($userExist)) {
    //         return $this->sendError('user_id not found.');
    //     }
    //     if (is_null($entrepriseExist)) {
    //         return $this->sendError('entreprise_id not found.');
    //     }
    //     $user = User::where('id', $request->user_id)->first();
    //     $adminExist = Admin::where('user_id', $user->id)->first();
    //     if ($adminExist) {
    //         return $this->sendError('admin is already exist.');
    //     }
    //     if ($user->role !== "admin") {
    //         return $this->sendError("this user is not admin");
    //     }
    //     $admin = Admin::create($request->all());
    //     return $this->sendResponse(new AdminResource($admin), 'admin Created Successfully.');
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = Admin::find($id);
        if (is_null($admin)) {
            return $this->sendError('admin not found.');
        }
        return $this->sendResponse(new AdminResource($admin), 'Admin is fetching Successfully .');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(AdminRequestUpdate $request, $id)
    // {
    //     $adminExist = Admin::where('id', $id)->exists();
    //     $entrepriseExist = Entreprise::find($request->entreprise_id);
    //     if ($adminExist == null) {
    //         return $this->sendError('admin is not exist.');
    //     }

    //     if (is_null($entrepriseExist)) {
    //         return $this->sendError('entreprise_id not found.');
    //     }
    //     $user = User::where('id', $request->user_id)->first();
    //     if ($user->role !== "admin") {
    //         return $this->sendError("this user is not client");
    //     }
    //     $admin = Admin::findOrFail($id);
    //     $admin->update($request->all());
    //     return $this->sendResponse(new AdminResource($admin), 'admin Updated Successfully.');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $adminExist = Admin::where('id', $id)->exists();
    //     if ($adminExist == null) {
    //         return $this->sendError('admin is not exist.');
    //     }
    //     $admin = Admin::findOrFail($id);
    //     $admin->delete();
    //     return $this->sendResponse([], 'admin Deleted Successfully.');
    // }
}
