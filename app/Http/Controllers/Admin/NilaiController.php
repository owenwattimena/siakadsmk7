<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Jurusan;
use App\Services\Kelas;
use App\Services\Nilai;
use App\Models\Semester;
use App\Imports\NilaiImport;
use Illuminate\Http\Request;
use App\Exports\PesertaExport;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class NilaiController extends Controller
{

    protected $semesterAktifId;

    public function __construct()
    {
        $semesterAktif = Semester::where('is_aktif', 1)->first();
        $this->semesterAktifId = $semesterAktif->id;
    }

    public function inputNilai()
    {
        $jurusan = Jurusan::all();
        $data['kelas'] = [];
        $data['jurusan'] = $jurusan;
        return view('admin.nilai.input-nilai.index', $data);
    }

    public function inputNilaiJurusan(Request $request)
    {
        $jurusan = Jurusan::where('kode', $request->jurusan_kode)->first();

        $dataKelas = DB::table('kelas')
            ->join('semester_jurusan', 'semester_jurusan.id', '=', 'kelas.semester_jurusan_id')
            ->join('semester', 'semester.id', '=', 'semester_jurusan.semester_id')
            ->join('matapelajarankurikulum', 'matapelajarankurikulum.id', '=', 'kelas.mapel_kuri_id')
            ->leftJoin('guru', 'guru.id', '=', 'kelas.guru_id')
            ->select('semester.nama_semester', 'semester_jurusan.semester_id', 'guru.nign', 'guru.nip', 'guru.nama as nama_guru', 'matapelajarankurikulum.id as mapel_kuri_id', 'matapelajarankurikulum.nama as mapel', 'matapelajarankurikulum.skm as mapel_skm', 'kelas.id as kelas_id', 'kelas.nama as kelas_nama', 'matapelajarankurikulum.semester as mapel_semester')
            ->where('semester_jurusan.jurusan_id', '=', $jurusan->id)
            ->where('semester_jurusan.semester_id',  '=', $this->semesterAktifId)
            ->orderBy(DB::raw("matapelajarankurikulum.semester, matapelajarankurikulum.nama, kelas.nama"))
            ->get();
        $jurusanSemua = Jurusan::all();
        $guru = Guru::all();
        $data['kelas'] = $dataKelas;
        $data['jurusan'] = $jurusanSemua;
        $data['jurusanKode'] = $jurusan->kode;
        $data['guru'] = $guru;
        return view('admin.nilai.input-nilai.index', $data);

    }

    public function downloadPeserta($kelasId, $type = 'xls')
    {
        $pesertaExport = new PesertaExport($kelasId);
        return Excel::download($pesertaExport, 'Peserta Kelas' . '.' . $type);
    }

    public function importNilai(Request $request, $kelasId)
    {
        Excel::import(new NilaiImport($kelasId), $request->file('import_file'));
        return back();
    }

    public function cetakNilai(Request $request, $kelasId)
    {
        $data['today'] = Carbon::now()->isoFormat('D MMMM Y');
        $data['kelasPeserta'] = Nilai::nilai($kelasId);
        $data['kelas'] = Kelas::kelas($kelasId);
        // dd($data);
        $pdf = PDF::loadView('guru.cetak-nilai', $data);
        if($request->cetak == 1) return $pdf->stream('nilai-peserta.pdf'); 
        return $pdf->download('nilai-peserta.pdf');
    }

    public function cetakNilaiSemester(Request $request, $semesterId)
    {
        $nis = Auth::user()->username;
        $data['today'] = Carbon::now()->isoFormat('D MMMM Y');
        $data['siswa'] = Siswa::where('nis', $nis)->first();
        $data['nilai'] = Nilai::nilaiSemester($nis, $semesterId);
        $pdf = PDF::loadView('siswa.cetak-nilai', $data);
        if($request->cetak == 1) return $pdf->stream('nilai-semester.pdf'); 
        return $pdf->download('nilai-semester.pdf');
    }
}
