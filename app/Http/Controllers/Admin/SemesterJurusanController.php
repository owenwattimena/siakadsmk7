<?php

namespace App\Http\Controllers\Admin;

use App\Models\Jurusan;
use App\Models\Semester;
use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use App\Models\SemesterJurusan;
use App\Http\Controllers\Controller;

class SemesterJurusanController extends Controller
{
    public function index($id)
    {
        $jurusan = Jurusan::all();
        $semester = Semester::findOrFail($id);   
        $semJur = SemesterJurusan::where('semester_id', $id)->get();
        $data['jurusan'] = $jurusan; 
        $data['semester'] = $semester; 
        $data['semesterJurusan'] = $semJur; 
        return view('admin.semester-jurusan.index',$data);
    }

    public function store(Request $request, $idSem)
    {
        $request->validate([
            'jurusan_id' => 'required|numeric',
            'tanggal_mulai_semester' => 'required|date',
            'tanggal_selesai_semester' => 'required|date',
            'tanggal_mulai_input_nilai' => 'required|date',
            'tanggal_selesai_input_nilai' => 'required|date',
        ]);

        $semJur = new SemesterJurusan;
        $semJur->semester_id = $idSem;
        $semJur->jurusan_id = $request->jurusan_id;
        $semJur->tanggal_mulai_semester = $request->tanggal_mulai_semester;
        $semJur->tanggal_selesai_semester = $request->tanggal_selesai_semester;
        $semJur->tanggal_mulai_input_nilai = $request->tanggal_mulai_input_nilai;
        $semJur->tanggal_selesai_input_nilai = $request->tanggal_selesai_input_nilai;

        if($semJur->save())
        {
            return redirect()->back()->with(AlertFormatter::success("Data Semester Jurusan berhasil di simpan."));
        }
        return redirect()->back()->with(AlertFormatter::danger("Data Semester Jurusan gagal di simpan."));
    }

    public function status($semId, $semJurId)
    {
        $semJur = SemesterJurusan::findOrFail($semJurId);
        $semJur->status_aktif = $semJur->status_aktif == 1 ? 0 : 1;
        if($semJur->save())
        {
            return redirect()->back()->with(AlertFormatter::success("Status Semester jurusan berhasil di simpan."));
        }
        return redirect()->back()->with(AlertFormatter::danger("Status Semester jurusan gagal di simpan."));
    }

    public function delete($semId, $semJurId)
    {
        if(SemesterJurusan::destroy($semJurId))
        {
            return redirect()->back()->with(AlertFormatter::success("Data Semester jurusan berhasil di hapus."));
        }
        return redirect()->back()->with(AlertFormatter::danger("Data Semester jurusan gagal di hapus."));
    }
}
