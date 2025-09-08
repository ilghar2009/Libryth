<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index(User $user){
        $musics = $user->musics()->map(function ($item){
            return [
                'id' => $item->id,
                'user_name' => $item->user?->name,
                'title' => $item->title,
                'description' => $item->description,
                'text' => $item->text,
                'music' => $item->music,
                'role' => $item->role,
            ];
        });

        return response()->json([
            'user' => $user,
            'musics' => $musics,
        ]);
    }

    public function edit(User $user){
        return response()->json($user);
    }

    public function update(Request $request,User $user){

        $request->validate([
            'name' => ['required', 'min:3', 'string'],
            'nick_name' => ['nullable','min:3', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', Password::min(8)->letters()->numbers()->symbols()],
        ]);

        $user->update([
           'name' => $request?->name,
           'nick_name' => $request->nick_name??null,
           'email' => $request->email,
           'password' => $request->password,
        ]);

        return true;
    }

}
