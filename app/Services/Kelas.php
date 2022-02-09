<?php 

namespace App\Services;

use Illuminate\Support\Facades\DB;

class Kelas{


    public static function kelas($kelasId)
    {
        $kelas = DB::table('kelas')
            ->join('semester_jurusan', 'semester_jurusan.id', '=', 'kelas.semester_jurusan_id')
            ->join('semester', 'semester.id', '=', 'semester_jurusan.semester_id')
            ->join('matapelajarankurikulum', 'matapelajarankurikulum.id', '=', 'kelas.mapel_kuri_id')
            ->leftJoin('guru', 'guru.id', '=', 'kelas.guru_id')
            ->select('semester.nama_semester', 'semester_jurusan.semester_id', 'guru.nign', 'guru.nip', 'guru.nama as nama_guru', 'matapelajarankurikulum.id as mapel_kuri_id', 'matapelajarankurikulum.nama as mapel', 'matapelajarankurikulum.skm as mapel_skm', 'kelas.id as kelas_id', 'kelas.nama as kelas_nama', 'matapelajarankurikulum.semester as mapel_semester')
            ->where('kelas.id', '=', $kelasId)
            ->orderBy(DB::raw("matapelajarankurikulum.semester, matapelajarankurikulum.nama, kelas.nama"))
            ->first();
        return $kelas;
    }
    
}