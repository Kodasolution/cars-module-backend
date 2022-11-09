<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequestStore;
use App\Http\Resources\UserResource;
use App\Models\Admin;
use App\Models\Client;
use App\Models\Entreprise;
use App\Models\SuperAdmin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function Register(UserRequestStore $request)
    {
        // return $request->all();
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

    public function Login(Request $request)
    {
        
        // return Auth::guard('super_admins')->user()->email;
        $data = $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);
        
        if (!Auth::attempt($data)) {
            return $this->sendError('the credentiels is not valid.');
        }
        $user = User::where('email', $data['email'])->firstOrFail();
        
        if ($user->role === "super_admin") {
            $token = $user->createToken("authorToken")->plainTextToken;
            return $this->sendResponseToken(new UserResource($user), $token, 'User Created Successfully.');
        } elseif ($user->role === "admin") {
            $token = $user->createToken("authorToken")->plainTextToken;
            return $this->sendResponseToken(new UserResource($user), $token, 'User Created Successfully.');
        } elseif ($user->role === "client") {
           
            $token = $user->createToken("authorToken")->plainTextToken;
            return $this->sendResponseToken(new UserResource($user), $token, 'User Created Successfully.');
        }else{
            return $this->sendError('the credentiels is not valid.');
        }
    }
    public function sendResponseToken($result, $pam = null, $message)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'token' => $pam,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }
}
