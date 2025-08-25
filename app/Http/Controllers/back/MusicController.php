<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Music;
use Illuminate\Http\Request;

class MusicController extends Controller
{

    public function index()
    {
        $music = Music::all();

        $songs = $music->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'description' => $item->description,
                'user' => $item->user,
                'text' => $item->text,
                'music' => $item->music,
                'role' => $item->role,
            ];
        });

        return response()->json($songs);
    }

    public function update(Request $request, Music $music)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'text' => 'required',
            'music' => 'required',
            'role' => 'required',
        ]);

        $music->update($request->all());

        return true;
    }

    public function destroy(Music $music)
    {
        $music->delete();
        return true;
    }
}
