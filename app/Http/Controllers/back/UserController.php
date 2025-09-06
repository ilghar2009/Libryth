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

    public function update(User $user){
        $user->update(['role' => !$user->role]);
        return true;
    }
}
