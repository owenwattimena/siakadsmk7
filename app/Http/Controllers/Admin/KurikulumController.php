<?php

namespace App\Http\Controllers\Admin;

use App\Models\Jurusan;
use App\Models\Kurikulum;
use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;

class KurikulumController extends Controller
{
    public function index()
    {
        $jurusan = Jurusan::all();
        $kurikulum = Kurikulum::with('matapelajaran')->get();
        $data['jurusan'] = $jurusan;
        $data['kurikulum'] = $kurikulum;
        
        return view('admin.kurikulum.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jurusan_kode' => 'required',
            'tahun'        => 'required',
            'nama'         => 'required'
        ]);

        $kurikulum = new Kurikulum;
        $kurikulum->jurusan_kode = $request->jurusan_kode;
        $kurikulum->tahun        = $request->tahun;
        $kurikulum->nama         = $request->nama;
        
        if($kurikulum->save())
        {
            return redirect()->back()->with(AlertFormatter::success("Data Kurikulum berhasil di simpan."));
        }
        return redirect()->back()->with(AlertFormatter::danger("Data Kurikulum gagal di simpan."));

    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'jurusan_kode' => 'required',
            'tahun'        => 'required',
            'nama'         => 'required'
        ]);

        $kurikulum = Kurikulum::findOrFail($id);
        $kurikulum->jurusan_kode = $request->jurusan_kode;
        $kurikulum->tahun        = $request->tahun;
        $kurikulum->nama         = $request->nama;
        
        if($kurikulum->save())
        {
            return redirect()->back()->with(AlertFormatter::success("Data Kurikulum berhasil di ubah."));
        }
        return redirect()->back()->with(AlertFormatter::danger("Data Kurikulum gagal di ubah."));

    }

    public function delete($id)
    {
        if(Kurikulum::destroy($id))
        {
            return redirect()->back()->with(AlertFormatter::success("Data Kurikulum berhasil di hapus."));
        }
        return redirect()->back()->with(AlertFormatter::danger("Data Kurikulum gagal di hapus."));
    }
}
