<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pengaturan;
use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;

class VisiMisiConttroller extends Controller
{
    public function index()
    {
        $data['pengaturan'] = Pengaturan::first();
        return view('admin.visi-misi.index', $data);
    }

    public function storeVisi(Request $request)
    {
        $request->validate([
            'visi' => 'required',
        ]);

        $visi = $request->input('visi');

        $pengaturan = Pengaturan::first();
        if($pengaturan == null) {
            $pengaturan = new Pengaturan();
        }
        $pengaturan->visi = $visi;
        if($pengaturan->save()){

            return back()->with(AlertFormatter::success("Data VISI berhasil di simpan."));
        }

        return back()->with(AlertFormatter::danger("Data VISI gagal di simpan."));
    }
    public function storeMisi(Request $request)
    {
        $request->validate([
            'misi' => 'required',
        ]);

        $misi = $request->input('misi');

        $pengaturan = Pengaturan::first();
        if($pengaturan == null) {
            $pengaturan = new Pengaturan();
        }
        $pengaturan->misi = $misi;
        if($pengaturan->save()){

            return back()->with(AlertFormatter::success("Data MISI berhasil di simpan."));
        }

        return back()->with(AlertFormatter::danger("Data MISI gagal di simpan."));
    }
}
