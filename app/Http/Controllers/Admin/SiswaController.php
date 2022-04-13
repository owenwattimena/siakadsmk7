<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\Kurikulum;
use App\Exports\SiswaExport;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::all();
        $jurusan = Jurusan::all();
        $kurikulum = Kurikulum::all();
        $data['jurusan'] = $jurusan;
        $data['siswa'] = $siswa;
        $data['kurikulum'] = $kurikulum;
        return view('admin.siswa.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|numeric',
            'nama' => 'required',
            'email' => 'email|required',
            'jurusan_kode' => 'required',
            'angkatan' => 'required',
            'kurikulum_id' => 'required',
            'kelompok' => 'required',
        ]);

        $jurusan = Jurusan::where('kode', $request->jurusan_kode)->first();

        $siswa               = new Siswa;
        $siswa->nis          = $request->nis;
        $siswa->nama         = $request->nama;
        $siswa->jurusan_kode = $request->jurusan_kode;
        $siswa->jurusan_id   = $jurusan->id;
        $siswa->angkatan     = $request->angkatan;
        $siswa->kurikulum_id = $request->kurikulum_id;
        $siswa->kelompok     = $request->kelompok;

        if($siswa->save())
        {
            $newUser             = new User;
            $newUser->name       = $request->nama;
            $newUser->email      = $request->email;
            $newUser->username   = $request->nis;
            $newUser->password   = Hash::make('password');
            $newUser->nis        = $request->nis;
            $newUser->level_id   = 4;

            $newUser->save();

            return redirect()->back()->with(AlertFormatter::success("Data Siswa berhasil di tambahkan."));
        }
        return redirect()->back()->with(AlertFormatter::danger("Data Siswa gagal di tambahkan."));
    }

    public function status($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->status_aktif = $siswa->status_aktif == 1 ? 0 : 1;
        if($siswa->save())
        {
            return redirect()->back()->with(AlertFormatter::success("Status Siswa berhasil di simpan."));
        }
        return redirect()->back()->with(AlertFormatter::danger("Status Siswa gagal di simpan."));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'email|required',
            'kelompok' => 'required',
            'kurikulum_id' => 'required',
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->nama = $request->nama;
        $siswa->kelompok = $request->kelompok;
        $siswa->kurikulum_id = $request->kurikulum_id;

        if($siswa->save())
        {
            $newUser = User::where('nis', $siswa->nis)->first();
            $newUser->name = $request->nama;
            $newUser->email = $request->email;

            $newUser->save();
            
            return redirect()->back()->with(AlertFormatter::success("Data Siswa berhasil di simpan."));
        }
        return redirect()->back()->with(AlertFormatter::danger("Data Siswa gagal di simpan."));
    }

    public function delete($id)
    {
        $siswa = Siswa::findOrFail($id);
        if(Siswa::destroy($id))
        {
            User::where('nis', $siswa->nis)->delete();
            return redirect()->back()->with(AlertFormatter::success("Data Siswa berhasil di hapus."));
        }
        return redirect()->back()->with(AlertFormatter::danger("Data Siswa gagal di hapus."));
    }

    public function exportSiswa(Request $request)
    {

        $dataSiswa = [];
        if($request->tipe_siswa == 'lama')
        {
            $siswaExport = new SiswaExport($dataSiswa, $request->tipe_siswa);
        }
        else
        {
            $siswaExport = new SiswaExport($dataSiswa);
        }
        return Excel::download($siswaExport, 'siswa.xlsx');
    }

    public function importSiswa(Request $request){
        $import = new SiswaImport;
        Excel::import($import, $request->file('file'));
        return back();
    }
}
