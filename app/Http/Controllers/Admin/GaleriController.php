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

    public function update(Request $request, $idGaleri)
    {
        $request->validate([
            'deskripsi' => 'required',
        ]);
        $galeri = Galeri::find($idGaleri);
        $oldGaleri = $galeri->foto;
        $galeri->deskripsi_galeri = $request->deskripsi;
        if($request->hasFile('foto')){
            $request->validate([
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            $path = Storage::putFile('public/galeri', $request->file('foto'));
            $galeri->foto = $path;
            Storage::delete($oldGaleri);

        }
        if ($galeri->save()) {

            return back()->with(AlertFormatter::success('Galeri berhasil diubah'));
        }
        return back()->with(AlertFormatter::danger('Galeri gagal diubah'));
    }

    public function delete($idGaleri)
    {
        $galeri = Galeri::find($idGaleri);
        if ($galeri->delete()) {
            Storage::delete($galeri->foto);
            return back()->with(AlertFormatter::success('Galeri berhasil dihapus'));
        }
        return back()->with(AlertFormatter::danger('Galeri gagal dihapus'));
    }
}
