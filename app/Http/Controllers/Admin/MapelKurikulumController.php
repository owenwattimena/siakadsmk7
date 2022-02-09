<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kurikulum;
use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use App\Models\Matapelajarankurikulum;

class MapelKurikulumController extends Controller
{
    public function index($id)
    {
        $kurikulum = Kurikulum::findOrFail($id);
        $matapelajaran = Matapelajarankurikulum::where('kurikulum_id', $id)->orderBy('semester', 'ASC')->get();
        $data['kurikulum'] = $kurikulum;
        $data['matapelajaran'] = $matapelajaran;
        return view('admin.mapel-kurikulum.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kurikulum_id' => 'required',
            'nama'         => 'required',
            'semester'     => 'required',
            'skm'          => 'required',
        ]);
        

        $mapelKurikulum = new Matapelajarankurikulum;
        $mapelKurikulum->kurikulum_id = $request->kurikulum_id;
        $mapelKurikulum->nama = $request->nama;
        $mapelKurikulum->semester            = $request->semester;
        $mapelKurikulum->skm                 = $request->skm;

        if($mapelKurikulum->save())
        {
            return redirect()->back()->with(AlertFormatter::success("Data Matapelajaran berhasil di simpan."));
        }
        return redirect()->back()->with(AlertFormatter::danger("Data Matapelajaran gagal di simpan."));

    }

    public function update(Request $request, $idKur, $idMapel)
    {
        $request->validate([
            'kurikulum_id' => 'required',
            'nama'         => 'required',
            'semester'     => 'required',
            'skm'          => 'required',
        ]);
        

        $mapelKurikulum                      = Matapelajarankurikulum::findOrFail($idMapel);
        $mapelKurikulum->kurikulum_id        = $request->kurikulum_id;
        $mapelKurikulum->nama                = $request->nama;
        $mapelKurikulum->semester            = $request->semester;
        $mapelKurikulum->skm                 = $request->skm;

        if($mapelKurikulum->save())
        {
            return redirect()->back()->with(AlertFormatter::success("Data Matapelajaran berhasil di ubah."));
        }
        return redirect()->back()->with(AlertFormatter::danger("Data Matapelajaran gagal di ubah."));

    }

    public function delete($idKur, $idMapel)
    {
        if(Matapelajarankurikulum::destroy($idMapel))
        {
            return redirect()->back()->with(AlertFormatter::success("Data Matapelajaran berhasil di hapus."));
        }
        return redirect()->back()->with(AlertFormatter::danger("Data Matapelajaran gagal di hapus."));
    }
}
