<?php

namespace App\Http\Controllers\Admin;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusan    = Jurusan::with('kurikulum')->get();
        $data       = [
            'jurusan' => $jurusan
        ];
        return view('admin.jurusan.main', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kode'  => 'required|unique:jurusan,kode'
        ]);

        $jurusan = new Jurusan;
        $jurusan->nama = $request->nama;
        $jurusan->kode = $request->kode;
        if($jurusan->save())
        {
            return redirect()->back()->with(AlertFormatter::success("Data Jurusan berhasil di tambahkan."));
        }
        return redirect()->back()->with(AlertFormatter::danger("Data Jurusan gagal di tambahkan."));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'kode'  => 'required|unique:jurusan,kode'
        ]);
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->nama = $request->nama;
        $jurusan->kode = $request->kode;
        if($jurusan->save())
        {
            return redirect()->back()->with(AlertFormatter::success("Data Jurusan berhasil di ubah."));
        }
        return redirect()->back()->with(AlertFormatter::danger("Data Jurusan gagal di ubah."));
    }
    
    public function delete($id)
    {
        if(Jurusan::destroy($id))
        {
            return redirect()->back()->with(AlertFormatter::success("Data Jurusan berhasil di hapus."));
        }
        return redirect()->back()->with(AlertFormatter::danger("Data Jurusan gagal di hapus."));
    }
}
