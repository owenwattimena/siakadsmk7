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
                'kd1' => $row['kd1'] ?? 0,
                'kd2' => $row['kd2'] ?? 0,
                'kd3' => $row['kd3'] ?? 0,
                'kd4' => $row['kd4'] ?? 0,
                'kd5' => $row['kd5'] ?? 0,
                'kd6' => $row['kd6'] ?? 0,
                'kd7' => $row['kd7'] ?? 0,
                'kd8' => $row['kd8'] ?? 0,
                'kd9' => $row['kd9'] ?? 0,
                'kd10' => $row['kd10'] ?? 0,
                'kd10' => $row['kd10'] ?? 0,
                'rata_rata_kd' => $row['rata_rata_kd'] ?? 0,
                'pts' => $row['pts'] ?? 0,
                'pas' => $row['pas'] ?? 0,
                'kinerja1' => $row['kinerja_1'] ?? 0,
                'kinerja2' => $row['kinerja_2'] ?? 0,
                'rata_rata_kinerja' => $row['rata_rata_kinerja'] ?? 0,
                'proyek1' => $row['proyek_1'] ?? 0,
                'proyek2' => $row['proyek_2'] ?? 0,
                'rata_rata_proyek' => $row['rata_rata_proyek'] ?? 0,
                'portofolio1' => $row['portofolio_1'] ?? 0,
                'portofolio2' => $row['portofolio_2'] ?? 0,
                'rata_rata_portofolio' => $row['rata_rata_portofolio'] ?? 0,
            ];

            if(DB::table('dbs_nilai')->where('dbs_detail_id', $siswa->id)->exists()){
                DB::table('dbs_nilai')->where('dbs_detail_id', $siswa->id)->delete();
            }

            DB::table('dbs_detail')->where('id', $siswa->id)->update([
                "n_raport_pengetahuan" => $row['n_raport_pengetahuan'],
                "predikat_pengetahuan" => $row['predikat_pengetahuan'],
                "n_raport_ketrampilan" => $row['n_raport_ketrampilan'],
                "predikat_ketrampilan" => $row['predikat_ketrampilan'],
            ]);
        }

        if(!empty($insert))
        {
            DB::table('dbs_nilai')->insert($insert);
        }
    }
}