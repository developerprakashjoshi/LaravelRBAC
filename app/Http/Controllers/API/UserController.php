<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
Use App\Models\{Role,Permission};
class UserController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function login(Request $request): Response
    {
        $input = $request->all();
        Auth::attempt($input);
        $user = Auth::user();
        $token = $user->createToken('example')->accessToken;
        return Response(['status' => 200,'token' => $token],200);
    }
    public function register(Request $request)
    {
       $user=new User($request->all());
       $user->save();
       return Response(['status' => 200,'data' => $user],200);
    }
    public function me()
    {
        if(Auth::guard('api')->check()){
            $user = Auth::guard('api')->user();
            //Assigning role to user
            // $role=Role::where('slug','editor')->first();
            // $user->roles()->attach($role);
            // Check Role
            //dd($user->hasRole('editor'));
            // dd($user->hasRole('author'));
            //Assigning Permission to user
            // $permission=Permission::first();
            // $user->permissions()->attach($permission);

            //Checking Permission
            dd($user->can('add-post'));

            dd($user->permissions);
            //return Response(['data' => $user],200);
        }
        return Response(['data' => 'Unauthorized'],401);
    }
    public function logout()
    {
        if(Auth::guard('api')->check()){
            $accessToken = Auth::guard('api')->user()->token();
                \DB::table('oauth_refresh_tokens')
                    ->where('access_token_id', $accessToken->id)
                    ->update(['revoked' => true]);
            $accessToken->revoke();
            return Response(['data' => 'Unauthorized','message' => 'User logout successfully.'],200);
        }
        return Response(['data' => 'Unauthorized'],401);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
