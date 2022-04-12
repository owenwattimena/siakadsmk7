<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AlertFormatter;
use App\Models\Galeri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $data['galeri'] = Galeri::all();
        return view('admin.galeri.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'deskripsi' => 'required',
        ]);


        $path = Storage::putFile('public/galeri', $request->file('foto'));

        $galeri = new Galeri;
        $galeri->foto = $path;
        $galeri->deskripsi_galeri = $request->deskripsi;
        if ($galeri->save()) {
            return back()->with(AlertFormatter::success('Galeri berhasil ditambahkan'));
        }
        return back()->with(AlertFormatter::danger('Galeri gagal ditambahkan'));
    }
}
