<?php

namespace App\Http\Controllers\Guru;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{

    public function dashboard()
    {
        return view('guru.dashboard');
    }

    public function kelasSemester(Request $request){
        $nign = Auth::user()->nign;
        $semId = $request->semester_id;
        $dataAmpuSemester = DB::table('guru')
            ->join('kelas', 'kelas.guru_id', '=', 'guru.id')
            ->join('semester_jurusan', 'semester_jurusan.id', '=', 'kelas.semester_jurusan_id')
            ->join('matapelajarankurikulum', 'matapelajarankurikulum.id', '=', 'kelas.mapel_kuri_id')
            ->select('guru.nign', 'guru.nip', 'matapelajarankurikulum.id', 'matapelajarankurikulum.nama as mapel', 'matapelajarankurikulum.semester', 'matapelajarankurikulum.skm', 'kelas.nama as nama_kelas', 'kelas.id as kelas_id')
            ->where('semester_jurusan.semester_id', $semId)
            ->where('guru.nign', $nign)
            ->orderBy('mapel')
            ->get();
        $semesterGuru = $this->semesterGuru($nign);
        $data['semesterGuru'] = $semesterGuru;
        $data['ampuSemester'] = $dataAmpuSemester;
        // dd($semesterGuru);
        return view('guru.daftar-kelas', $data);
    }



    protected function semesterGuru($nign)
    {
        $semesterGuru = DB::table('guru')
            ->join('kelas', 'kelas.guru_id', '=', 'guru.id')
            ->join('semester_jurusan', 'semester_jurusan.id','=', 'kelas.semester_jurusan_id')
            ->join('semester', 'semester.id', '=', 'semester_jurusan.semester_id')
            ->select(DB::raw('distinct(semester_jurusan.semester_id) as semester_id, semester.tahun_pelajaran, semester.jenis_semester'))
            ->where('guru.nign', $nign)
        ->get();
        return $semesterGuru;
    }

    public function pesertaKelasSemester($id)
    {
        $dataKelas = DB::table('kelas')
            ->join('dbs_detail', 'dbs_detail.kelas_id', '=', 'kelas.id')
            ->leftJoin('dbs_nilai', 'dbs_nilai.dbs_detail_id', '=', 'dbs_detail.id')
            ->join('dbs', 'dbs.id', '=', 'dbs_detail.dbs_id')
            ->join('siswa', 'siswa.nis', '=', 'dbs.siswa_nis')
            ->join('semester_jurusan', 'semester_jurusan.id', '=', 'kelas.semester_jurusan_id')
            ->join('matapelajarankurikulum', 'matapelajarankurikulum.id', '=', 'kelas.mapel_kuri_id')
            ->leftJoin('guru', 'guru.id', '=', 'kelas.guru_id')
            ->select(
                'siswa.nis',
                'siswa.nama',
                'semester_jurusan.semester_id',
                'guru.nign',
                'guru.nip',
                'guru.nama as nama_guru',
                'matapelajarankurikulum.id as mapel_kuri_id',
                'matapelajarankurikulum.nama as mapel',
                'matapelajarankurikulum.skm',
                'kelas.id',
                'kelas.nama as nama_kelas',
                'dbs_nilai.nilai_pengetahuan',
                'dbs_nilai.nilai_ketrampilan',
                'dbs_nilai.nilai_akhir',
                'dbs_detail.bobot_nilai',
                'dbs_detail.predikat as nilai_huruf'
            )
            ->where('dbs_detail.kelas_id', '=', $id)
            ->orderBy('siswa.nis')
        ->get();
        $data['kelasId'] = $id;
        $data['peserta'] = $dataKelas;
        // dd($data);
        return view('guru.peserta-kelas', $data);
    }

    public function pengumumanKelasSemester($idKelas)
    {
        $pengumuman = Pengumuman::where('kelas_id', $idKelas)->get();
        $mapel = DB::table('kelas')
            ->join('matapelajarankurikulum', 'matapelajarankurikulum.id', 'kelas.mapel_kuri_id')
            ->select('matapelajarankurikulum.nama')
            ->where('kelas.id', $idKelas)->first();
        $data = [
            'pengumuman' => $pengumuman,
            'idKelas' => $idKelas,
            'mapel' => $mapel->nama
        ];
        return view('guru.pengumuman', $data);
    }


    public function pengumumanKelasStore(Request $request, $kelasId)
    {
        $request->validate([
            'judul' => 'required',
            'isi'   => 'required'
        ]);

        $pengumuman = new Pengumuman;
        $pengumuman->judul = $request->judul;
        $pengumuman->isi = $request->isi;
        $pengumuman->kelas_id = $kelasId;

        if($pengumuman->save())
        {
            return redirect()->back()->with(AlertFormatter::success("Pengumuman berhasil di tambahkan."));
            
        }
        return redirect()->back()->with(AlertFormatter::danger("Pengumuman gagal di tambahkan."));
    }

    public function pengumumanKelasUpdate(Request $request){
        $request->validate([
            'judul' => 'required',
            'isi'   => 'required'
        ]);
        $id = $request->id;
        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->judul = $request->judul;
        $pengumuman->isi = $request->isi;

        if($pengumuman->save())
        {
            return redirect()->back()->with(AlertFormatter::success("Pengumuman berhasil di simpan."));
        }
        return redirect()->back()->with(AlertFormatter::danger("Pengumuman gagal di simpan."));
    }
    
    public function pengumumanKelasDelete($kelasId, $pengumumanId)
    {
        if(Pengumuman::destroy($pengumumanId)){
            return redirect()->back()->with(AlertFormatter::success("Pengumuman berhasil di hapus."));
        }
        return redirect()->back()->with(AlertFormatter::danger("Pengumuman gagal di hapus."));
    }
}
