<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Dbs;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\Semester;
use App\Models\Dbsdetail;
use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    protected $semesterAktifId;

    public function __construct()
    {
        $semesterAktif = Semester::where('is_aktif', 1)->first();
        $this->semesterAktifId = $semesterAktif->id;
    }

    public function showSiswaRegister(Request $request)
    {

        $kelas = DB::table('siswa')
            ->join('jurusan', 'jurusan.id', '=', 'siswa.jurusan_id')
            ->join('dbs', 'dbs.siswa_nis', '=', 'siswa.nis')
            ->join('semester_jurusan', 'semester_jurusan.id', '=', 'dbs.semester_jurusan_id')
            ->join('semester', 'semester.id', '=', 'semester_jurusan.semester_id')
            ->select("semester.nama_semester", "siswa.nis", "siswa.nama", "siswa.angkatan", "siswa.kelompok", "jurusan.kode", "dbs.paket_semester")
            ->where('siswa.status_aktif', '=', 1)
            ->where('semester_jurusan.status_aktif', '=', 1)
            ->where('semester.id', '=', $this->semesterAktifId)
            ->get();
        $jurusan = Jurusan::all();
        $data['kelas'] = $kelas;
        // $data['jurusan'] = $jurusan;

        return view('admin.kelas.register-siswa.index', $data);
    }

    public function kelasMahasiswaRegister(Request $request)
    {
        // Select semua siswa yang aktif
        $semesterSiswaAktif = DB::table('siswa')
            ->select('nis', 'angkatan', 'jurusan_id')
            ->where('status_aktif', '=', 1)
            ->orderBy('nis')
            ->get();
        // Cek jika terdapat data siswa yang aktif
        if ($semesterSiswaAktif->count() > 0) {
            // mencari jurusan yang aktif sesuai dengan jurusan siswa aktif
            foreach ($semesterSiswaAktif as $siswaAktif) {
                $semesterJurusanAktif = DB::table('semester')
                    ->join('semester_jurusan', 'semester_jurusan.semester_id', '=', 'semester.id')
                    ->select('semester_jurusan.id as semester_jurusan')
                    ->where('semester_jurusan.jurusan_id', '=', $siswaAktif->jurusan_id)
                    ->where('semester_jurusan.semester_id', '=', $this->semesterAktifId)
                    ->where('semester_jurusan.status_aktif', '=', 1)
                    ->first();
                if (isset($semesterJurusanAktif)) {
                    try {
                        $semesterJurusanId = $semesterJurusanAktif->semester_jurusan;
                    } catch (Exception $e) {
                        continue;
                    }
                } else {
                    continue;
                    return redirect()->back()->with(AlertFormatter::danger('Registrasis Kelas Semester Gagal.</br>Mohon Periksa Kembali Pengaturan Semester Akademik dan Semester Jurusan.'));
                }

                $cariPaketSemMax = DB::table('dbs')
                    ->join('semester_jurusan', 'semester_jurusan.id', '=', 'dbs.semester_jurusan_id')
                    ->select('dbs.paket_semester', 'semester_jurusan.semester_id')
                    ->where('dbs.siswa_nis', '=', $siswaAktif->nis)
                    ->orderBy('dbs.paket_semester', 'desc')
                    ->first();

                if (isset($cariPaketSemMax)) {
                    if ($cariPaketSemMax->semester_id > $this->semesterAktifId) {
                        if ($cariPaketSemMax->paket_semester > 1) {
                            $semesterRegister = $cariPaketSemMax->paket_semester - 1;
                        } else $semesterRegister = 1;
                    } else {
                        $semesterRegister = $cariPaketSemMax->paket_semester + 1;
                    }
                    // $semesterRegister = $cariPaketSemMax->paket_semester + 1;
                    $dbsSiswa = DB::table('siswa')
                        ->join('dbs', 'dbs.siswa_nis', '=', 'siswa.nis')
                        ->join('semester_jurusan', 'semester_jurusan.id', '=', 'dbs.semester_jurusan_id')
                        ->select('siswa.nis', 'semester_jurusan.id')
                        // ->where('dbs.paket_semester', '=', $semesterRegister )
                        ->where('semester_jurusan.semester_id', '=', $this->semesterAktifId)
                        ->where('dbs.siswa_nis', '=', $siswaAktif->nis)
                        ->orderBy('siswa.nis')
                        ->first();
                } else $semesterRegister = 1;
                if (!isset($dbsSiswa)) {
                    $dbs = new Dbs;
                    $dbs->semester_jurusan_id           = $semesterJurusanId;
                    $dbs->siswa_nis                     = $siswaAktif->nis;
                    $dbs->paket_semester                = $semesterRegister;
                    $dbs->save();
                }
            }
            return redirect()->back()->with(AlertFormatter::success('Registrasi Kelas Semester Berhasil'));
        }
        return redirect()->back()->with(AlertFormatter::danger('Registrasis Kelas Semester Gagal'));
    }

    public function showKelasRegister()
    {
        $jurusan = Jurusan::all();
        // $dataKelas = DB::table('kelas')
        //     ->join('semester_jurusan', 'semester_jurusan.id', '=', 'kelas.semester_jurusan_id')
        //     ->join('matapelajarankurikulum', 'matapelajarankurikulum.id', '=', 'kelas.mapel_kuri_id')
        //     ->leftJoin('guru', 'guru.id', '=', 'kelas.guru_id')
        //     ->select('semester_jurusan.semester_id', 'kelas.guru_id', 'guru.nama', 'matapelajarankurikulum.nama', 'matapelajarankurikulum.skm', 'matapelajarankurikulum.semester')
        //     ->where('semester_jurusan.semester_id', '=', $this->semesterAktifId)
        //     ->orderBy('matapelajarankurikulum.semester')
        // ->get();
        $data['kelas'] = [];
        $data['jurusan'] = $jurusan;
        // dd($data);

        return view('admin.kelas.register-kelas.index', $data);
    }

    public function kelasRegister(Request $request)
    {
        $jurusan = Jurusan::where('kode', $request->jurusan_kode)->first();
        $kurikulum = DB::table('siswa')
            ->join('dbs', 'dbs.siswa_nis', '=', 'siswa.nis')
            ->join('semester_jurusan', 'semester_jurusan.id', '=', 'dbs.semester_jurusan_id')
            ->select('siswa.angkatan', 'dbs.paket_semester', 'semester_jurusan.semester_id', 'semester_jurusan.id as semester_jurusan_id', 'siswa.kurikulum_id')
            ->where('siswa.status_aktif', '=', 1)
            ->where('siswa.jurusan_kode', '=', $request->jurusan_kode)
            ->where('semester_jurusan.status_aktif', '=', 1)
            ->where('semester_jurusan.semester_id', '=', $this->semesterAktifId)
            // ->groupBy('siswa.angkatan')
            ->orderBy('siswa.angkatan')
            ->get();

        // $kurikulum = $kurikulum->groupBy('angkatan');
        if ($kurikulum->count()) {
            foreach ($kurikulum as $key => $itemKurikulum) {
                $cariKelompok = DB::table('siswa')
                    ->select('kelompok')
                    ->where('angkatan', '=', $itemKurikulum->angkatan)
                    ->orderBy('kelompok')
                    ->get();
                // $cariKelompok = $cariKelompok->groupBy('kelompok');

                foreach ($cariKelompok as $key => $itemCariKelompok) {
                    $namaKelompok = $itemCariKelompok->kelompok;
                    $mapelAktif = DB::table('kurikulum')
                        ->join('matapelajarankurikulum', 'matapelajarankurikulum.kurikulum_id', '=', 'kurikulum.id')
                        ->join('jurusan', 'jurusan.kode', '=', 'kurikulum.jurusan_kode')
                        ->select('matapelajarankurikulum.id', 'matapelajarankurikulum.nama', 'kurikulum.id as kurikulum_id')
                        ->where('kurikulum.id', '=', $itemKurikulum->kurikulum_id)
                        ->where('kurikulum.jurusan_kode', '=', $request->jurusan_kode)
                        ->where('matapelajarankurikulum.semester', '=', $itemKurikulum->paket_semester)
                        ->orderBy('id')
                        ->get();


                    foreach ($mapelAktif as $key => $itemMapelAktif) {
                        $cekMapelKelas = DB::table('kelas')
                            ->select('id')
                            ->where('mapel_kuri_id', '=', $itemMapelAktif->id)
                            ->where('semester_jurusan_id', '=', $itemKurikulum->semester_jurusan_id)
                            ->where('nama', '=', $namaKelompok)
                            ->get();
                        if (!$cekMapelKelas->count()) {
                            $kelas = new Kelas;
                            $kelas->nama        = $namaKelompok;
                            $kelas->mapel_kuri_id = $itemMapelAktif->id;
                            $kelas->semester_jurusan_id = $itemKurikulum->semester_jurusan_id;
                            $kelas->save();
                        }
                    }
                }
            }
            $this->registerPesertaKelas();
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

            // dd($data);
            return view('admin.kelas.register-kelas.index', $data)->with(AlertFormatter::success("Registrasi Kelas Berhasil"));
            // return redirect()->back()->with();
        }
        return redirect()->back()->with(AlertFormatter::danger("Registrasi Kelas Gagal"));
    }

    protected function registerPesertaKelas()
    {
        $dataDbs = DB::table('dbs')
            ->join('semester_jurusan', 'semester_jurusan.id', '=', 'dbs.semester_jurusan_id')
            ->join('siswa', 'siswa.nis', '=', 'dbs.siswa_nis')
            ->select('semester_jurusan.semester_id', 'dbs.id', 'siswa.kelompok', 'dbs.paket_semester', 'semester_jurusan.jurusan_id')
            ->where('semester_jurusan.semester_id', '=', $this->semesterAktifId)
            // ->where('semester_jurusan.id', '=', $kelas->semester_jurusan_id)
            ->orderBy('dbs.id')
            ->get();

        foreach ($dataDbs as $key => $dataDbsItem) {
            $dataKelas = DB::table('kelas')
                ->join('semester_jurusan', 'semester_jurusan.id', '=', 'kelas.semester_jurusan_id')
                ->join('matapelajarankurikulum', 'matapelajarankurikulum.id', '=', 'kelas.mapel_kuri_id')
                ->select('semester_jurusan.semester_id', 'kelas.id', 'semester_jurusan.jurusan_id', 'kelas.nama')
                ->where('semester_jurusan.semester_id', '=', $this->semesterAktifId)
                ->where('matapelajarankurikulum.semester', '=', $dataDbsItem->paket_semester)
                ->where('kelas.nama', '=', $dataDbsItem->kelompok)
                ->where('semester_jurusan.jurusan_id', '=', $dataDbsItem->jurusan_id)
                // ->where('kelas.mapel_kuri_id', '=', $kelas->mapel_kuri_id)
                // ->where('kelas.nama', '=', $kelas->nama)
                ->orderBy('kelas.id')
                ->get();
            foreach ($dataKelas as $dataKelasItem) {
                $cekDbsDetail = DB::table('dbs_detail')
                    ->select('id')
                    ->where('dbs_id', '=', $dataDbsItem->id)
                    ->where('kelas_id', '=', $dataKelasItem->id)
                    ->first();
                if (empty($cekDbsDetail)) {
                    $dbsDetail = new Dbsdetail;
                    $dbsDetail->dbs_id   = $dataDbsItem->id;
                    $dbsDetail->kelas_id = $dataKelasItem->id;
                    $dbsDetail->save();
                }
            }
        }
    }

    public function peserta($id)
    {
        // die;
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
        return view('admin.kelas.peserta-kelas.index', $data);
    }

    public function addGuruMapel(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'id_kelas'  => 'required',
            'id_guru'   => 'required'
        ], [
            'id_guru.required' => 'Harap pilih Guru'
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error($validator->errors()->toArray(), 'data');
        }

        $kelas = Kelas::findOrFail($request->id_kelas);
        if($kelas)
        {
            $kelas->guru_id = $request->id_guru;
            if(!$kelas->save())
            {
                return ResponseFormatter::error([], 'Gagal menambahkan guru ke kelas');
            }
            return ResponseFormatter::success([], 'Berhasil menambahkan guru ke kelas');
        }

        return ResponseFormatter::success($request->id_guru, 'data');
    }
}
