<?php

namespace App\Imports;

use App\Models\Siswa;
use Facade\Ignition\DumpRecorder\Dump;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
// use Maatwebsite\Excel\Concerns\WithValidation;

class SiswaImport implements ToCollection, WithHeadingRow
{

    private $registeredData = [];

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $this->registeredData;
        $insert = [];
        foreach($rows as $row){
            $siswa = Siswa::where('nis', $row['nis'])->first();
            if($siswa){
                $this->registeredData[] = $siswa;
            }else{
                $insert[] = [
                    'nis' => $row['nis'],
                    'nama' => $row['nama'], 
                    'jurusan_kode' => $row['kode_jurusan'],
                    'angkatan' => $row['angkatan'], 
                    'kelompok' => $row['kelas'], 
                    'jurusan_id' => $row['id_jurusan'], 
                    'kurikulum_id' => $row['kurikulum_id'],
                ];
            }
        }
        if($insert){
            // insert into DB
            // dd($insert);
        }
    }

    public function registeredData()
    {
        return $this->registeredData;
    }

}
