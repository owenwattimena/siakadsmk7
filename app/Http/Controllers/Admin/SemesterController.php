<?php

namespace App\Http\Controllers\Admin;

use App\Models\Semester;
use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SemesterController extends Controller
{
    public function index()
    {
        $semester = Semester::orderBy('id', 'desc')->get();
        $data['semester'] = $semester;
        return view('admin.semester.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'tahun' => 'required',
            'jenis_semester' => 'required',
        ]);

        $semester = new Semester;
        $semester->nama_semester = $request->nama;
        $semester->tanggal_mulai = $request->tanggal_mulai;
        $semester->tanggal_selesai = $request->tanggal_selesai;
        $semester->tahun_pelajaran = $request->tahun;
        $semester->jenis_semester = $request->jenis_semester;

        if($semester->save())
        {
            $request->session()->put('semId', $semester->id);
            DB::table('semester')->where('id', '!=', $semester->id)->update([
                'is_aktif' => 0
            ]);
            return redirect()->back()->with(AlertFormatter::success("Data Semester berhasil di simpan."));
        }
        return redirect()->back()->with(AlertFormatter::danger("Data Semester gagal di simpan."));
    }

    public function status(Request $request, $id)
    {
        $semester = Semester::findOrFail($id);
        $semester->is_aktif = $semester->is_aktif == 1 ? 0 : 1;
        if($semester->save())
        {
            if($semester->is_aktif == 1){
                $request->session()->put('semId', $semester->id);
                DB::table('semester')->where('id', '!=', $id)->update(['is_aktif' => 0]);
            }
            return redirect()->back()->with(AlertFormatter::success("Status Semester berhasil di simpan."));
        }
        return redirect()->back()->with(AlertFormatter::danger("Status Semester gagal di simpan."));
    }

    public function delete($id)
    {
        if(Semester::destroy($id))
        {
            return redirect()->back()->with(AlertFormatter::success("Data Semester akademik berhasil di hapus."));
        }
        return redirect()->back()->with(AlertFormatter::danger("Data Semester akademik gagal di hapus."));
    }
}
