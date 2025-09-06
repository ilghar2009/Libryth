<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return $users;
    }

    public function show(User $user){

        $artist = $user->map(function ($item){
            return
                [
                    'id' => $item->id,
                    'title' => $item->title,
                    'text' => $item->text,
                    'music' => $item->music,
                    'role'=> $item->role,
                ];
        });

        return response()->json($artist);
    }

    // This function toggles the user role (admin <-> user) and returns it
    public function update(User $user){
        $role = $user->is_admin? 0 : 1;
        $user->update(['is_admin' => $role]);
        return true;
    }

    public function destroy(User $user){
        $user->delete();
        return true;
    }
}
