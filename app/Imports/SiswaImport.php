<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Siswa;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Facade\Ignition\DumpRecorder\Dump;
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
            foreach($insert as $i){
                $siswa = new Siswa;
                $siswa->nis = $i['nis'];
                $siswa->nama = $i['nama'];
                $siswa->jurusan_kode = $i['jurusan_kode'];
                $siswa->jurusan_id = $i['jurusan_id'];
                $siswa->angkatan = $i['angkatan'];
                $siswa->kelompok = $i['kelompok'];
                $siswa->kurikulum_id = $i['kurikulum_id'];
                if($siswa->save())
                {
                    $newUser             = new User;
                    $newUser->name       = $siswa->nama;
                    $newUser->email      = $i['email']??"";
                    $newUser->username   = $siswa->nis;
                    $newUser->password   = Hash::make('password');
                    $newUser->nis        = $siswa->nis;
                    $newUser->level_id   = 4;

                    $newUser->save();
                }
            }
        }
    }

    public function registeredData()
    {
        return $this->registeredData;
    }

}
