<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Siswa;
use App\Services\Nilai;
use App\Models\Semester;
use App\Models\Saranmasukan;
use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{

    public function index()
    {
        $semesterAktif = Semester::where('is_aktif', 1)->first();
        $pengumuman = DB::table('pengumuman')
            ->join('kelas', 'kelas.id', 'pengumuman.kelas_id')
            ->join('semester_jurusan', 'semester_jurusan.id', 'kelas.semester_jurusan_id')
            ->join('semester', 'semester.id', 'semester_jurusan.semester_id')
            ->join('guru', 'guru.id', 'kelas.guru_id')
            ->join('matapelajarankurikulum', 'matapelajarankurikulum.id', 'kelas.mapel_kuri_id')
            ->select('matapelajarankurikulum.nama as mapel','pengumuman.judul', 'pengumuman.isi', 'guru.nama', 'pengumuman.created_at')
            ->where('semester.id', $semesterAktif->id)
            ->orderBy('created_at', 'desc')
        ->get();
        $data['pengumuman'] = $pengumuman;
        return view('siswa.dashboard', $data);
    }

    public function nilai(Request $request)
    {
        $nis = Auth::user()->nis;
        $semesterId = $request->semester_id;
        $data['listSemester'] = $this->semesterSiswa($nis);
        if($semesterId)
        {
            $data['semesterId'] = $semesterId;
            $data['dataBelajar'] = Nilai::nilaiSemester($nis, $semesterId);
        }
        return view('siswa.nilai', $data);
    }

    protected function semesterSiswa($nis)
    {
        $listSemesterSiswa = DB::table('siswa')
            ->select('semester.id', 'semester.tahun_pelajaran', 'semester.jenis_semester')
            ->join('dbs', 'dbs.siswa_nis', 'siswa.nis')
            ->join('semester_jurusan', 'semester_jurusan.id', 'dbs.semester_jurusan_id')
            ->join('semester', 'semester.id', 'semester_jurusan.semester_id')
            ->where('siswa.nis', $nis)
        ->get();
        
        return $listSemesterSiswa;
    }

    public function saranSiswa()
    {
        $nis = Auth::user()->nis;
        $siswa = Siswa::where('nis', $nis)->first();
        $data['saran'] = Saranmasukan::where('siswa_id', $siswa->id)->get();
        return view('siswa.saran', $data);
    }

    public function saranSiswaStore(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi'   => 'required'
        ]);

        $nis = Auth::user()->nis;
        $siswa = Siswa::where('nis', $nis)->first();

        $saran = new Saranmasukan;

        $saran->siswa_id = $siswa->id;
        $saran->judul = $request->judul;
        $saran->isi = $request->isi;

        if($saran->save())
        {
            return redirect()->back()->with(AlertFormatter::success('Saran dan masukan berhasil di tambahkan'));
        }
        else
        {
            return redirect()->back()->with(AlertFormatter::danger('Saran dan masukan gagal di tambahkan'));
        }
    }

    public function saranSiswaUpdate(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi'   => 'required'
        ]);

        $saran = Saranmasukan::find($request->id);

        $saran->judul = $request->judul;
        $saran->isi = $request->isi;

        if($saran->save())
        {
            return redirect()->back()->with(AlertFormatter::success('Saran dan masukan berhasil di ubah'));
        }
        else
        {
            return redirect()->back()->with(AlertFormatter::danger('Saran dan masukan gagal di ubah'));
        }
    }

    public function saranSiswaDelete($id)
    {
        $saran = Saranmasukan::find($id);

        if($saran->delete())
        {
            return redirect()->back()->with(AlertFormatter::success('Saran dan masukan berhasil di hapus'));
        }
        else
        {
            return redirect()->back()->with(AlertFormatter::danger('Saran dan masukan gagal di hapus'));
        }
    }

    // protected function dataBelajarSiswa($nis = '0', $semesterId = 0)
    // {
    //     $dbs = DB::table('dbs_detail')
    //         ->join('kelas', 'kelas.id', 'dbs_detail.kelas_id')
    //         ->leftJoin('guru', 'guru.id', 'kelas.guru_id')
    //         ->leftJoin('dbs_nilai', 'dbs_nilai.dbs_detail_id', 'dbs_detail.id')
    //         ->join('matapelajarankurikulum', 'matapelajarankurikulum.id', 'kelas.mapel_kuri_id')
    //         ->join('dbs', 'dbs.id', 'dbs_detail.dbs_id')
    //         ->join('semester_jurusan', 'semester_jurusan.id', 'dbs.semester_jurusan_id')
    //         ->join('siswa', 'siswa.nis', 'dbs.siswa_nis')
    //         ->select(
    //             'semester_jurusan.semester_id', 
    //             'matapelajarankurikulum.id', 
    //             'matapelajarankurikulum.nama',
    //             'matapelajarankurikulum.skm',
    //             'guru.nama as guru',
    //             'siswa.nis',
    //             'siswa.nama as siswa',
    //             'siswa.kelompok as kelas',
    //             'dbs_nilai.nilai_pengetahuan',
    //             'dbs_nilai.nilai_ketrampilan',
    //             'dbs_nilai.nilai_akhir',
    //             'dbs_detail.bobot_nilai',
    //             'dbs_detail.predikat'
    //         )
    //         ->where('semester_jurusan.semester_id', $semesterId)
    //         ->where('dbs.siswa_nis', $nis)
    //         ->get();
    //     return $dbs;
    // }
}
