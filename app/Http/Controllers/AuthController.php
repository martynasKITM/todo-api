<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{

  public function register(Request $request){
      $validator = Validator::make($request->all(),[
          'name'=>'required|string|max:255',
          'email'=>'required|string|email|unique:users',
          'password'=>'required|string|min:8'
      ]);

      if($validator->fails()){
          return response()->json(['error'=>$validator->errors()]);
      }

      $user =User::create([
          'name'=>$request->name,
          'email'=>$request->email,
          'password'=>Hash::make($request->password)
      ]);
      $token=$user->createToken('auth_token')->plainTextToken;

      return response()->json([
          'data'=>$user,
          'access_token'=>$token,
          'message'=>'Registration complete'
      ]);
  }

  public function login(Request $request){
      if(!Auth::attempt($request->only('email','password'))){
          return response()->json(['error'=>'Unauthorized',401]);
      }

      $user = User::where('email',$request->email)->firstorFail();
      $token = $user->createToken('auth_token')->plainTextToken;

      return response()->json([
         'message'=>'Hello'." ".$user->name.". Your token is: ".$token
      ]);
  }

  public function logout(Request $request){
      $request->user()->tokens()->delete();

      return response()->json(['message'=>'Bye. You are logged out']);
  }

}
