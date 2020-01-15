<?php

namespace App\Http\Controllers;

use App\Album;
use Illuminate\Http\Request;

class AlbumsController extends Controller
{
    public function index()
    {
        $albums = Album::with('Photos')->get();
        return view('albums.index')->with('albums', $albums);
    }

    public function create()
    {
        return view('albums.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'cover_image' => 'image|max:1999',

        ]);

        // Get filename with extension
        $filenamewithExt = $request->file('cover_image')->getClientOriginalName();

        // Get just the file name
        $filename = pathinfo($filenamewithExt, PATHINFO_FILENAME);

        // Get the file extension
        $extension = $request->file('cover_image')->getClientOriginalExtension();

        // Create new file name
        $filenameToStore = $filename . '_' . time() . '.' . $extension;

        // Upload image 
        $path = $request->file('cover_image')->storeAs('public/album_covers', $filenameToStore);

        // Create Album
        $album = new Album;
        $album->name = $request->input('name');
        $album->description = $request->input('description');
        $album->cover_image = $filenameToStore;

        $album->save();

        return redirect('/albums')->with('success', 'Album created');
    }

    public function show($id)
    {
        $album = Album::with('Photos')->find($id);
        return view('albums.show')->with('album', $album);
    }
}
