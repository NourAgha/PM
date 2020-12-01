<?php

namespace App\Http\Controllers;
use App\Models\Organization;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $user_validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);
        $org_validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'domain_name' => 'required|string|between:2,100',
            'description' => 'required|string|max:500',

        ]);

        if($user_validator->fails()){
            return response()->json($user_validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
            $user_validator->validated(),
            ['password' => bcrypt($request->password)]
        ));
        $org=Organization::create(array_merge(
            $org_validator->validated()
        ));
        $user->organization_id=$org->id;
        $user->role_id=1;
        $user->save();

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user,
            'organization'=>$org
        ], 201);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        return response()->json(auth()->user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */

    protected function createNewToken($token){

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user(),
            'role'=>auth()->user()->role->name
        ]);
    }
    public function getAllTasks() {
        return response()->json(User::tasks());
    }
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json($user, 201);
    }

    // public function getAllEmployees()
    // {
    //     $org = Auth::user()->organization();
    //     $employees = DB::table('users')
    //     ->join('role', 'users.role_id', '=', 'role.role_id')
    //     ->where('role.name', '=', 'employee','and','organization_id','=',$org->id)
    //      ->get();
    //     return response()->json($org, 201);
    // }
    // public function getAllAdmins(){
    //     $org = Auth::user()->organization();
    //     $admins = DB::table('users')
    //    ->join('role', 'users.role_id', '=', 'role.role_id')
    //    ->where('role.name', '=', 'admin','and','organization_id','=',$org->id)
    //     ->get();
    //     return response()->json($admins, 201);
    // }
    // public function getAllDevelopers(){
    //     $org = Auth::user()->organization();
    //     $developers = DB::table('users')
    //     ->join('role', 'users.role_id', '=', 'role.role_id','organization_id','=',$org->id)
    //     ->where('role.name', '=', 'developer')
    //      ->get();
    //      return response()->json($developers, 201);
    // }
}
