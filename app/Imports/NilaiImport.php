<?php 

namespace App\Imports;

use App\Models\Dbsnilai;
use App\Models\Semester;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NilaiImport implements ToModel, WithCalculatedFormulas, WithHeadingRow{

    protected $semesterAktifId;
    protected $kelasId;

    public function __construct($kelasId)
    {
        $semesterAktif = Semester::where('is_aktif', 1)->first();
        $this->semesterAktifId = $semesterAktif->id;
        $this->kelasId = $kelasId;
    }

    public function model(array $row)
    {
        $siswa = DB::table('dbs_detail')
            ->join('dbs', 'dbs.id', '=', 'dbs_detail.dbs_id')
            ->join('semester_jurusan', 'semester_jurusan.id', '=', 'dbs.semester_jurusan_id')
            ->select('dbs_detail.id')
            ->where('semester_jurusan.semester_id', '=', $this->semesterAktifId)
            ->where('dbs_detail.kelas_id', '=', $this->kelasId)
            ->where('dbs.siswa_nis', '=', $row['nis'])->first();
        // dd($row);
        if(!empty($siswa))
        {
            $insert[] = [
                'dbs_detail_id'     => $siswa->id,
                'nilai_pengetahuan' => $row['nilai_pengetahuan'],
                'nilai_ketrampilan' => $row['nilai_keterampilan'],
                'nilai_akhir'       => $row['nilai_akhir'],
                'kehadiran'         => $row['kehadiran'],
            ];

            if(DB::table('dbs_nilai')->where('dbs_detail_id', $siswa->id)->exists()){
                DB::table('dbs_nilai')->where('dbs_detail_id', $siswa->id)->delete();
            }

            DB::table('dbs_detail')->where('id', $siswa->id)->update([
                "bobot_nilai" => $row['bobot_nilai'],
                "predikat" => $row['nilai_huruf']
            ]);
        }

        if(!empty($insert))
        {
            DB::table('dbs_nilai')->insert($insert);
        }
    }
}