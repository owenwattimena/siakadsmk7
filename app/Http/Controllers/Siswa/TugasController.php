<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Semester;
use App\Models\SemesterJurusan;
use Illuminate\Support\Facades\Storage;

class TugasController extends Controller
{
    public function index()
    {
        $siswa  = Siswa::where('nis',auth()->user()->nis)->first();
        $semesterJurusan = SemesterJurusan::where('status_aktif',1)->first();
        $data['siswa'] = $siswa;
        $dbsLast = $siswa->dbs->last();
        $tugas = DB::table('tugas')
            ->select('matapelajarankurikulum.nama as mapel', 'guru.nama as guru', 'tugas.id', 'tugas.judul', 'tugas.keterangan', 'tugas.file')
            ->join('kelas', 'kelas.id', '=', 'tugas.kelas_id')
            ->join('matapelajarankurikulum', 'kelas.mapel_kuri_id', '=', 'matapelajarankurikulum.id')
            ->join('guru', 'kelas.guru_id', '=', 'guru.id')
            ->join('semester_jurusan', 'semester_jurusan.id', '=', 'kelas.semester_jurusan_id')
            ->join('dbs', 'dbs.semester_jurusan_id', '=', 'semester_jurusan.id')
            ->where('matapelajarankurikulum.semester', '=', $dbsLast->paket_semester)
            ->where('semester_jurusan.status_aktif', '=', 1)
            ->where('dbs.siswa_nis', '=', $siswa->nis)
            ->get();
        foreach ($tugas as $key => $value) {
            $detail = DB::table('detail_tugas')->where('tugas_id', $value->id)->where('siswa_id', $siswa->id)->first();
            if($detail)
            {
                $tugas[$key]->status = 1;
            }
            else
            {
                $tugas[$key]->status = 0;
            }
        }
        $data['tugas'] = $tugas;
        return view('siswa.tugas', $data);
    }

    public function unggah(Request $request)
    {
        $request->validate([
            'keterangan' => 'required',
            'file' => 'required'
        ]);
        // dd($request->all());
        $siswa  = Siswa::where('nis',auth()->user()->nis)->first();

        $oldData = DB::table('detail_tugas')->where('tugas_id', $request->id_tugas)->where('siswa_id', $siswa->id)->first();
        if($oldData)
        {
            return back()->with(AlertFormatter::danger('Anda sudah mengumpulkan tugas ini'));
        }

        $path = Storage::putFile('public/detail-tugas', $request->file('file'));

        $status = DB::table('detail_tugas')->insert([
            'siswa_id' => $siswa->id,
            'tugas_id' => $request->id_tugas,
            'keterangan' => $request->keterangan,
            'file' => $path,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if($status)
        {
            return back()->with(AlertFormatter::success('Berhasil mengirim tugas'));
        }
        else
        {
            return back()->with(AlertFormatter::danger('Gagal mengirim tugas'));
        }
    }
}
