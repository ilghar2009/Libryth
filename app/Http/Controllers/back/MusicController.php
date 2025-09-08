<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Music;
use Illuminate\Http\Request;

class MusicController extends Controller
{

//    public function index()
//    {
//        $music = Music::all();
//
//        $songs = $music->map(function ($item) {
//            return [
//                'id' => $item->id,
//                'title' => $item->title,
//                'description' => $item->description,
//                'user' => $item->user->name,
//                'music' => $item->music,
//                'role' => $item->role,
//            ];
//        });
//
//        return response()->json($songs);
//    }

    public function update(Request $request, Music $music)
    {
        $request->validate([
            'role' => ['required'],
        ]);

        $music->update([
            'role' => $request->role,
        ]);

        return true;
    }

    public function destroy(Music $music)
    {
        $music->delete();
        return true;
    }
}
