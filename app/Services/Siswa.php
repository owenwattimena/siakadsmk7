<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

class Siswa{
    public static function data($dataSiswa = [])
    {
        // $data = [];
        // $siswa = collect($dataSiswa)->map->only(['nis', 'nama', 'jurusan_kode', 'angkatan', 'kelompok', 'jurusan_id', 'kurikulum_id'])->all();
        $siswa = collect($dataSiswa);
        return $siswa;
    }
}
