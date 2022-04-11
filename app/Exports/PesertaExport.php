<?php 

namespace App\Exports;

use App\Services\Nilai;
use Maatwebsite\Excel\Concerns\WithStyles;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PesertaExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithProperties
{
    protected $kelasId;
    public $kelasNama;

    public function __construct($kelasId)
    {
        $this->kelasId = $kelasId;
    }

    public function collection()
    {
        $dataPeserta = Nilai::nilai($this->kelasId);
        return new Collection($dataPeserta);
    }

    public function headings():array
    {
        return [
            'No', 
            'NIS', 
            'Nama', 
            'KD1', 
            'KD2', 
            'KD3', 
            'KD4', 
            'KD5', 
            'KD6', 
            'KD7', 
            'KD8', 
            'KD9', 
            'KD10', 
            'Rata Rata KD', 
            'PTS', 
            'PAS',
            'N. Raport Pengetahuan', 
            'Predikat Pengetahuan',  
            'Kinerja 1', 
            'Kinerja 2', 
            'Rata Rata Kinerja', 
            'Proyek 1', 
            'Proyek 2', 
            'Rata Rata Proyek', 
            'Portofolio 1', 
            'Portofolio 2', 
            'Rata Rata Portofolio', 
            'N. Raport Ketrampilan', 
            'Predikat Ketrampilan', 
        ];
    }

    public function properties(): array
    {
        return [
            'creator'        => config('app.name'),
            // 'lastModifiedBy' => 'Patrick Brouwers',
            'title'          => 'Daftar Peserta kelas '. $this->kelasNama,
            // 'description'    => 'Latest Invoices',
            // 'subject'        => 'Invoices',
            'keywords'       => 'peserta kelas,export,spreadsheet',
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