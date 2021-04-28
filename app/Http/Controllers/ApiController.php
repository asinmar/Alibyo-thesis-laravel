<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Resident;
use Validator;
use App\User;
use App\Distributor;
use Hash;
use Auth;
class ApiController extends Controller
{

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
            'username' => 'required',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        if(Auth::user()->acc_position != "Distributor"){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        if(Auth::user()->acc_status == "Disabled"){
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
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
            // 'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
    // public function postman(){
    //     $post = Resident::all();
    //     return $post;
    // }


//     public function login(Request $request){

//         // $user = array(
//         //     'username'=> $request->get('username'),
//         //     'password'=>  Hash::make($request->get('password'))
//         // );
//         // // return $user;
//         // if(Auth::attempt($user)){
//         //     return "horay";
//         // }
//         // else{
//         //     return 'boo';
//         // }
//         $pass = Hash::make($request->get('password'));
//         // return $pass;
//         $dis = User::where('username',$request->get('username'))->get();
//         if(!(Hash::check($request->get('password'),Auth::user()->password))){
//             $validator = Validator::make($request->all(), [
//                 'username' => 'required',
//                 'password' => 'required|string|min:6',
//             ]);
    
//             if ($validator->fails()) {
//                 return response()->json($validator->errors(), 422);
//             }
    
//             if (! $token = auth()->attempt($validator->validated())) {
            
//                 return response()->json(['error' => 'Unauthorized'], 401);
//             }
    
//             return $this->createNewToken($token);
//             return "asdas";
//         }
//         // if(count($dis) > 0){
//         //     return $dis;
//         // }
//         // else{
//         //     return "asdsad";
//         // }
        
//    }
    // public function login(Request $request){
    // 	$validator = Validator::make($request->all(), [
    //         'username' => 'required',
    //         'password' => 'required|string|min:6',
    //     ]);
    //     $user = User::where('username',$request->get('username'))->first();
    //     if(!(Hash::check($request->get('password'),Auth::user()->password))){
    //         if ($validator->fails()) {
    //             return response()->json($validator->errors(), 422);
    //         }
    //         if (! $token = auth()->attempt($validator->validated())) {
    //             return response()->json(['error' => 'Unauthorized'], 401);
    //         }
    //         return 'asd';
    //         return $this->createNewToken($token);
    //     }
    // }
}
