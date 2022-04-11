<?php 

namespace App\Services;

use Illuminate\Support\Facades\DB;

class Nilai{

    public static function nilaiKelas($idKelas)
    {
        return DB::table('kelas')
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
            'semester_jurusan.semester_id',
            'guru.nign',
            'guru.nip',
            'guru.nama as nama_guru',
            'matapelajarankurikulum.id as mapel_kuri_id',
            'matapelajarankurikulum.nama as mapel',
            'matapelajarankurikulum.skm',
            'kelas.id',
            'kelas.nama as nama_kelas',
            'dbs.paket_semester',
            'dbs_nilai.kd1',
            'dbs_nilai.kd2',
            'dbs_nilai.kd3',
            'dbs_nilai.kd4',
            'dbs_nilai.kd5',
            'dbs_nilai.kd6',
            'dbs_nilai.kd7',
            'dbs_nilai.kd8',
            'dbs_nilai.kd9',
            'dbs_nilai.kd10',
            'dbs_nilai.rata_rata_kd',
            'dbs_nilai.pts',
            'dbs_nilai.pas',
            'dbs_nilai.kinerja1',
            'dbs_nilai.kinerja2',
            'dbs_nilai.rata_rata_kinerja',
            'dbs_nilai.proyek1',
            'dbs_nilai.proyek2',
            'dbs_nilai.rata_rata_proyek',
            'dbs_nilai.portofolio1',
            'dbs_nilai.portofolio2',
            'dbs_nilai.rata_rata_portofolio',
            'dbs_detail.n_raport_pengetahuan',
            'dbs_detail.predikat_pengetahuan',
            'dbs_detail.n_raport_ketrampilan',
            'dbs_detail.predikat_ketrampilan')
        ->where('dbs_detail.kelas_id', '=', $idKelas)
        ->orderBy('siswa.nis')
    ->get();
    }

    public static function nilai($idKelas)
    {
        $dataPeserta = array();
        $peserta = self::nilaiKelas($idKelas);
        
        $no = 0;
        foreach ($peserta as $key => $itemPeserta) {
            $dataPeserta[] = collect([
                ++$no,
                $itemPeserta->nis,
                $itemPeserta->nama,
                $itemPeserta->kd1,
                $itemPeserta->kd2,
                $itemPeserta->kd3,
                $itemPeserta->kd4,
                $itemPeserta->kd5,
                $itemPeserta->kd6,
                $itemPeserta->kd7,
                $itemPeserta->kd8,
                $itemPeserta->kd9,
                $itemPeserta->kd10,
                $itemPeserta->rata_rata_kd,
                $itemPeserta->pts,
                $itemPeserta->pas,
                $itemPeserta->n_raport_pengetahuan,
                $itemPeserta->predikat_pengetahuan,
                $itemPeserta->kinerja1,
                $itemPeserta->kinerja2,
                $itemPeserta->rata_rata_kinerja,
                $itemPeserta->proyek1,
                $itemPeserta->proyek2,
                $itemPeserta->rata_rata_proyek,
                $itemPeserta->portofolio1,
                $itemPeserta->portofolio2,
                $itemPeserta->rata_rata_portofolio,
                $itemPeserta->n_raport_ketrampilan,
                $itemPeserta->predikat_ketrampilan,
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