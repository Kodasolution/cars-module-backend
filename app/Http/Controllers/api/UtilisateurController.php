<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UtilisateurResquestStore;
use App\Http\Requests\UtilisateurResquestUpdate;
use App\Http\Resources\UserResource;
use App\Http\Resources\UtilisateurResource;
use App\Models\Admin;
use App\Models\Client;
use App\Models\Entreprise;
use App\Models\SuperAdmin;
use App\Models\User;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $utilisateur = User::all();
        if (sizeof($utilisateur) == 0) {
            return $this->sendError('Utilisateur not found.');
        }
        return $this->sendResponse(UtilisateurResource::collection($utilisateur), 'fetch is called Successfully.');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UtilisateurResquestStore $request)
    {
        DB::beginTransaction();
        try {
            if ($request->role === 'admin') {
                if ($request->entreprise != null) {
                    $user = User::create($request->all());
                    $user_id = DB::getPdo()->lastInsertId();
                    $entrepriseExist = Entreprise::where('id', $request->entreprise)->exists();
                    if ($entrepriseExist == null) {
                        return $this->sendError('Entreprise is not exist.');
                    }
                    Admin::create([
                        "user_id" => $user_id,
                        "entreprise_id" => $request->entreprise,
                    ]);
                } else {
                    return $this->sendError('entreprise is required.');
                }
            } elseif ($request->role == "super_admin") {
                $user = User::create($request->all());
                $user_id = DB::getPdo()->lastInsertId();
                SuperAdmin::create([
                    "user_id" => $user_id,
                ]);
            } else {
                $user = User::create($request->all());
                $user_id = DB::getPdo()->lastInsertId();
                Client::create([
                    "user_id" => $user_id,
                ]);
            }
            DB::commit();
            return $this->sendResponse(new UserResource($user), 'User Created Successfully.');

        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError('error in creating user');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $utilisateur = User::find($id);
        if (is_null($utilisateur)) {
            return $this->sendError('Utilisateur not found.');
        }
        return $this->sendResponse(new UserResource($utilisateur), 'Utilisateur is fetching Successfully .');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UtilisateurResquestUpdate $request, $id)
    {
        DB::beginTransaction();
        try {
            $utilisateurExist = Utilisateur::where('id', $id)->exists();
            if ($utilisateurExist == null) {
                return $this->sendError('Utilisateur is not exist.');
            }
            $utilisateur = Utilisateur::findOrFail($id);
            if ($utilisateur->role !== $request->role) {
                switch ($request->role) {
                    case 'super_admin':
                        $utilisateur->update($request->all());
                        SuperAdmin::create([
                            "user_id" => $utilisateur->id,
                        ]);
                        break;
                    case 'admin':
                        $utilisateur->update($request->all());
                        if ($request->entreprise != null) {
                            $entrepriseExist = Entreprise::where('id', $request->entreprise)->exists();
                            if ($entrepriseExist == null) {
                                return $this->sendError('Entreprise is not exist.');
                            }
                            Admin::create(
                                [
                                    "user_id" => $utilisateur->id,
                                    "entreprise_id" => $request->entreprise,
                                ]
                            );
                        } else {
                            return $this->sendError('entreprise is required.');
                        }
                        break;
                    case 'client':
                        $utilisateur->update($request->all());
                        Client::create([
                            "user_id" => $utilisateur->id,
                        ]);
                    default:
                        return $this->sendError('this role not fund.');
                        break;
                }
            } else {
                $utilisateur->update($request->all());
            }
            DB::commit();
            return $this->sendResponse(new UtilisateurResource($utilisateur), 'User Updated Successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError('error in update user');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $utilisateurExist = User::where('id', $id)->exists();
            if ($utilisateurExist == null) {
                return $this->sendError('Utilisateur is not exist.');
            }
            $utilisateur = User::findOrFail($id);
            switch ($utilisateur->role) {
                case 'admin':
                    $utilisateur->admins()->delete();
                    $utilisateur->delete();
                    break;
                case 'super_admin':
                    $utilisateur->superAdmins()->delete();
                    $utilisateur->delete();
                    break;
                case 'client':
                    $utilisateur->clients()->delete();
                    $utilisateur->delete();
                default:
                    return $this->sendError('this role not fund.');
                    break;
            }
            DB::commit();
            return $this->sendResponse([], 'Utilisateur Deleted Successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError('error in update user');
        }
    }
}
