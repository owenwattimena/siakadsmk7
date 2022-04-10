<?php

namespace App\Exports;

use App\Services\Siswa;
use Maatwebsite\Excel\Concerns\WithStyles;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class SiswaExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithProperties
{

    public $dataSiswa;

    public function __construct($dataSiswa)
    {
        $this->dataSiswa = $dataSiswa;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return new Collection(Siswa::data($this->dataSiswa));
    }

    public function headings():array
    {
        return [
            'NIS', 
            'Nama', 
            'Kode Jurusan', 
            'Angkatan', 
            'Kelas', 
            'Id Jurusan', 
            'Kurikulum Id',
            'Email',
        ];
    }

    public function properties(): array
    {
        return [
            'creator'        => config('app.name'),
            // 'lastModifiedBy' => 'Patrick Brouwers',
            'title'          => 'Template Siswa',
            // 'description'    => 'Latest Invoices',
            // 'subject'        => 'Invoices',
            'keywords'       => 'siswa,export,spreadsheet',
            // 'category'       => 'Invoices',
            // 'manager'        => 'Patrick Brouwers',
            // 'company'        => 'Maatwebsite',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return[
            1    => ['font' => ['bold' => true]],
        ];
    }
}
