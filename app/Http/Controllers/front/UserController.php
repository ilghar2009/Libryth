<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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

    public function update(){

    }
}
