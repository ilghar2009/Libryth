<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Music;
use Illuminate\Http\Request;

class MusicController extends Controller
{

    public function store(Request $request)
    {
        //validate Values
            $values = $request->validate([
                'title' => 'required',
                'description' => 'required',
                'text' => 'required_with:music',
                'music' => 'required_with:tex|mimes:mp3,wav,aac,ogg|max:10240',//max 10MB
            ]);

        //upload music if is set
            $path = $request->file('music')->store('music', 'public');

        //create new recorde
            Music::create([
               'title' => $values['title'],
               'description' => $values['description'],
               'text' => $values['text'],
               'music' => $path,
               'user_id' => auth()->user()-> id,
            ]);

        return True;
    }

    public function edit(Music $music)
    {
        $songs = $music->map(function($item){
            return [
                'id' => $item->id,
                'title' => $item->title,
                'description' => $item->description,
                'text' => $item->text,
                'music' => $item->music,
                'user' => $item->user,
            ];
        });

        return response()->json(['songs' => $songs]);
    }

    public function update(Request $request, Music $music)
    {
        $request->validate([
           'title' => 'required',
           'description' => 'required',
           'text' => 'required_with:music',
           'music' => 'mimes:mp3,wav,aac,ogg|max:10240',
        ]);

        //upload music if is set
            $path = $request->file('music')->store('music', 'public');

            $music->update([
                'title' => $request->get('title')??$music->title,
                'description' => $request->get('description')??$music->description,
                'text' => $request->get('text')??$music->text,
                'music' => $path??$music->music,
            ]);

        return True;
    }

    public function destroy(Music $music)
    {
        $music->delete();
        return True;
    }
}
