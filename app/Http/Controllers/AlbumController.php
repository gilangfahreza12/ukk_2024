<?php

namespace App\Http\Controllers;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function create()
    {
        return view('albums.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_album' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $album = new Album([
            'nama_album' => $request->nama_album,
            'deskripsi' => $request->deskripsi,
            'user_id' => auth()->id(), // Otomatis gunakan ID user yang sedang login
        ]);

        $album->save();

        return redirect()->route('albums.index')->with('success', 'Album has been added');
    }

    public function index()
    {
        $albums = Album::with('user')->get(); // Mengambil semua album beserta data pengguna yang terkait
        return view('albums.index', ['albums' => $albums]);
    }


}