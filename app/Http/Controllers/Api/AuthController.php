<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
      $user = User::create([
            'name'=>$request->name,
            'email' =>$request->email,
            'password' => Hash::make($request->password),
      ]);
      return response()->json([
        "message"=> "Account created with succes"
      ],201);
    } 

    public function login(LoginRequest $request){
      $reqVal = $request->validated();
      if (!Auth::attempt($reqVal)) {
        return response()->json([
          'status'=>'Error',
          'message' => 'login failed email or password are incorrect',
        ], 401);
    }
    $user = Auth::user();

    $token = $user->createToken('api-token')->plainTextToken;

    return response()->json([
        'status'=>'Sucsses',    
        'message' => 'Login success',
        'token' => $token
    ], 200);

    }

    public function logout(Request $request)
    {
    Auth::user()->tokens()->delete();

    return response()->json([
        'message' => 'Logout successful'
    ], 200);
    } 
}
