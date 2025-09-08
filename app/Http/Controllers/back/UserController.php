<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return $users;
    }

    public function show(User $user){
        return response()->json($user);
    }

    public function update(Request $request,User $user){

        $user->update(
            ['is_admin' => $request->is_admin]
        );

        return true;
    }

    public function destroy(User $user){
        $user->delete();
        return true;
    }
}
