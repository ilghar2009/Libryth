<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use function Laravel\Prompts\password;

class AuthController extends Controller
{
    public function register(Request $request){

        $validate = Validator::make($request->all(),[
           'name'=> ['required','string','max:10', 'min:3'],
           'email'=> ['required','email','unique:users,email'],
           'password'=> ['required', Password::min(8)->letters()->numbers()->symbols()],
        ]);

        if($validate->fails()){
            return response()->json($validate->errors(), 422);
        }else {
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);

            if(isset($user)){
                $token = auth()->login($user);

                return response()->json([
                    'user' => $user,
                    'token' => $token,
                ]);
            }
        }
    }

    public function login(Request $request){

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(!$token = auth()->attempt($credentials)){
            return response()->json([
               'message' => 'Unauthorized'
            ], 401);

        }else {
            return response()->json([
                'token' => $token,
                'token_type' => 'bearer',
                'expire_time' => auth()->factory()->getTTL() * 60,
                'user' => auth()->user(),
            ]);
        }
    }

    function logout(){
        auth()->logout();
        return response()->json([
            'message' => 'Successfully logged out'
        ], 200);
    }
}
