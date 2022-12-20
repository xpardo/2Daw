<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class TokenController extends Controller
{
    /*****************
    * user *
    *****************/
    public function user(Request $request)
    {
        $user = User::where('email', $request->user()->email)->first();
        
        return response()->json([
            "success" => true,
            "user"    => $request->user(),
            "roles"   => $user->getRoleNames(),
        ]);
    }

 
    /*****************
    * Login *
    *****************/
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'     => 'required|email',
            'password'  => 'required',
        ]);
        if (Auth::attempt($credentials)) {
            // Get user
            $user = User::where([
                ["email", "=", $credentials["email"]]
            ])->firstOrFail();
            // Revoke all old tokens
            $user->tokens()->delete();
            // Generate new token
            $token = $user->createToken("authToken")->plainTextToken;
            // Token response
            return response()->json([
                "success"   => true,
                "authToken" => $token,
                "tokenType" => "Bearer"
            ], 200);
        } else {
            return response()->json([
                "success" => false,
                "message" => "Invalid login credentials"
            ], 401);
        }
    }



    /*****************
    * register *
    *****************/
    public function register(Request $request){

        // Validar los datos del usuario
        $register = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($register) {
            $user = User::create([
                'name'     => $register['name'],
                'email'    => $register['email'],
                'password' => Hash::make($register['password']),
            ]);
            
            $user->assignRole('author');

            $token = $user->createToken('authToken')->plainTextToken;
            
            return response()->json([
                'success' => true,
                'message' => 'Register successfull',
                'authToken' => $token,
                'tokenType' => 'Bearer',
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
            ], 422);
        }
    }


    /*****************
    * logout *
    *****************/
    public function logout(Request $request)
    {
        return response()->json([
            'success' => true,
            'message'    => "See you soon!",
        ], 200); 
    }
}
