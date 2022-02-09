<?php 

namespace App\Services;

use Illuminate\Support\Facades\DB;

class Nilai{

    public static function nilai($idKelas)
    {
        $dataPeserta = array();
        $peserta = DB::table('kelas')
            ->join('dbs_detail', 'dbs_detail.kelas_id', '=', 'kelas.id')
            ->leftJoin('dbs_nilai', 'dbs_nilai.dbs_detail_id', '=', 'dbs_detail.id')
            ->join('dbs', 'dbs.id', '=', 'dbs_detail.dbs_id')
            ->join('siswa', 'siswa.nis', '=', 'dbs.siswa_nis')
            ->join('semester_jurusan', 'semester_jurusan.id', '=', 'kelas.semester_jurusan_id')
            ->join('matapelajarankurikulum', 'matapelajarankurikulum.id', '=', 'kelas.mapel_kuri_id')
            ->leftJoin('guru', 'guru.id', '=', 'kelas.guru_id')
            ->select(
                'siswa.id', 
                'siswa.nis', 
                'siswa.nama', 
                'kelas.nama as nama_kelas',
                'dbs_nilai.nilai_pengetahuan',
                'dbs_nilai.nilai_ketrampilan',
                'dbs_nilai.nilai_akhir',
                'dbs_nilai.kehadiran',
                'dbs_detail.bobot_nilai',
                'dbs_detail.predikat as nilai_huruf')
            ->where('dbs_detail.kelas_id', '=', $idKelas)
            ->orderBy('siswa.nis')
        ->get();
        
        $no = 0;
        foreach ($peserta as $key => $itemPeserta) {
            $dataPeserta[] = collect([
                ++$no,
                $itemPeserta->nis,
                $itemPeserta->nama,
                $itemPeserta->nilai_pengetahuan,
                $itemPeserta->nilai_ketrampilan,
                $itemPeserta->nilai_akhir,
                $itemPeserta->bobot_nilai,
                $itemPeserta->nilai_huruf,
                $itemPeserta->kehadiran,
            ]);
        }
        return $dataPeserta;
    }

    public static function nilaiSemester($nis, $semesterId)
    {
        $dbs = DB::table('dbs_detail')
            ->join('kelas', 'kelas.id', 'dbs_detail.kelas_id')
            ->leftJoin('guru', 'guru.id', 'kelas.guru_id')
            ->leftJoin('dbs_nilai', 'dbs_nilai.dbs_detail_id', 'dbs_detail.id')
            ->join('matapelajarankurikulum', 'matapelajarankurikulum.id', 'kelas.mapel_kuri_id')
            ->join('dbs', 'dbs.id', 'dbs_detail.dbs_id')
            ->join('semester_jurusan', 'semester_jurusan.id', 'dbs.semester_jurusan_id')
            ->join('siswa', 'siswa.nis', 'dbs.siswa_nis')
            ->select(
                'semester_jurusan.semester_id', 
                'matapelajarankurikulum.id', 
                'matapelajarankurikulum.nama',
                'matapelajarankurikulum.skm',
                'guru.nama as guru',
                'siswa.nis',
                'siswa.nama as siswa',
                'siswa.kelompok as kelas',
                'dbs_nilai.nilai_pengetahuan',
                'dbs_nilai.nilai_ketrampilan',
                'dbs_nilai.nilai_akhir',
                'dbs_detail.bobot_nilai',
                'dbs_detail.predikat'
            )
            ->where('semester_jurusan.semester_id', $semesterId)
            ->where('dbs.siswa_nis', $nis)
            ->get();
        return $dbs;
    }
}