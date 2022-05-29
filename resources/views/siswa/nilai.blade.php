@extends('admin.templates.template')
@section('title')
<h1>
    Nilai
    <small>{{--Control panel--}}</small>
</h1>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ route('dashboard-siswa') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><i class="fa fa-dashboard"></i> Nilai</li>
</ol>
@endsection

@section('content')
@inject('serviceKelas', 'App\Services\Kelas')

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Data Belajar Siswa</h3>
    </div>
    <div class="box-body">
        <div class="margin padding">
            <form action="{{ route('dashboard-siswa.nilai') }}" method="post" class="form-horizontal">
                @csrf
                <div class="form-group">
                    <label for="semester_id" class="col-sm-6 control-label">Tahun Akademik</label>
                    <div class="col-sm-3">
                        <select name="semester_id" id="semester_id" class="form-control">
                            @foreach ($listSemester as $item)
                            <option value="{{ $item->id }}">{{ $item->tahun_pelajaran }} - {{ $item->jenis_semester % 2 == 0 ? 'Genap' : 'Ganjil' }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <button type="submit"class="btn btn-primary">Pilih</button>
                    </div>
                </div>
            </form>
        </div>
        @if (isset($dataBelajar))        
        <div class="box-body col-md-12" align="right" >  
            <a href="{{ route('dashboard-siswa.donwload-nilai', [$semesterId, 'cetak' => false]) }}" class="btn btn-flat btn-warning" value="Download Nilai Semester"><i class="fa fa-download"></i> Download</a>
            {{-- <a href="{{ route('dashboard-siswa.donwload-nilai', [$semesterId, 'cetak' => true],) }}" class="btn btn-flat btn-info" value="Cetak Nilai Semester"><i class="fa fa-print"></i> Cetak</a> --}}
          </div>
        <table class="table table-condensed">
            <tr>
                <th style="width: 10px">#</th>
                <th>Matapelajaran</th>
                <th>N. Raport Pengetahuan</th>
                <th>Predikat Pengetahuan</th>
                <th>N. Raport Ketrampilan</th>
                <th>Predikat Ketrampilan</th>
                <th>Pilihan</th>
            </tr>
            @foreach ($dataBelajar as $key => $value )
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $value->nama }}</td>        
                <td>{{ $value->n_raport_pengetahuan ?? '-' }}</td>
                <td>{{ $value->predikat_pengetahuan ?? '-' }}</td>
                <td>{{ $value->n_raport_ketrampilan ?? '-' }}</td>
                <td>{{ $value->predikat_ketrampilan ?? '-' }}</td>
                <td>
                    <button class="btn btn-small btn-primary" data-toggle="modal" data-target="#modal-default-{{ $key }}"><i class="fa fa-list"></i> Detail</button>
                </td>
                <div class="modal fade" id="modal-default-{{ $key }}">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Detail Nilai</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>Mata Pelajaran</label>
                                    </div>
                                    <div class="col-sm-9">
                                        {{ $dataBelajar->first()->nama }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>Kelas</label>
                                    </div>
                                    <div class="col-sm-9">
                                        {{ $serviceKelas->kelasSemester($dataBelajar->first()->paket_semester,$dataBelajar->first()->kelas) }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>Semester</label>
                                    </div>
                                    <div class="col-sm-9">
                                        {{ ($dataBelajar->first()->paket_semester%2 == 0 ? 'Genap' : 'Ganjil') }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>Tahun Pelajaran</label>
                                    </div>
                                    <div class="col-sm-9">
                                        {{ $dataBelajar->first()->tahun_pelajaran }}
                                    </div>
                                </div>
                                <hr>
                                @php
                                    $kd = [
                                        null,
                                        $value->kd1,
                                        $value->kd2,
                                        $value->kd3,
                                        $value->kd4,
                                        $value->kd5,
                                        $value->kd6,
                                        $value->kd7,
                                        $value->kd8,
                                        $value->kd9,
                                        $value->kd10,
                                    ];
                                @endphp
                                {{-- @for ($j=1; $j <= 10; $j++)    
                                <div class="row text-center" style="background-color:{{ $j%2 == 0 ? '#EEE' : '#FFF' }}; padding: 5px;">
                                    <div class="col-sm-6">
                                        KD{{ $j }}
                                    </div>
                                    <div class="col-sm-6">
                                        {{ $kd[$j] ?? '-' }}
                                    </div>
                                </div>
                                @endfor --}}
    
                                <div class="row text-center" style="background-color:#EEE; padding: 5px;">
                                    <div class="col-sm-3">
                                        KD1
                                    </div>
                                    <div class="col-sm-3">
                                        {{ $kd[1] ?? '-' }}
                                    </div>
                                    <div class="col-sm-3">
                                        Kinerja 1
                                    </div>
                                    <div class="col-sm-3">
                                        {{ $value->kinerja1 ?? '-' }}
                                    </div>
                                </div>
                                <div class="row text-center" style="background-color:#FFF; padding: 5px;">
                                    <div class="col-sm-3">
                                        KD2
                                    </div>
                                    <div class="col-sm-3">
                                        {{ $kd[2] ?? '-' }}
                                    </div>
                                    <div class="col-sm-3">
                                        Kinerja 2
                                    </div>
                                    <div class="col-sm-3">
                                        {{ $value->kinerja2 ?? '-' }}
                                    </div>
                                </div>
                                <div class="row text-center" style="background-color:#EEE; padding: 5px;">
                                    <div class="col-sm-3">
                                        KD3
                                    </div>
                                    <div class="col-sm-3">
                                        {{ $kd[3] ?? '-' }}
                                    </div>
                                    <div class="col-sm-3">
                                        Rata-rata Kinerja
                                    </div>
                                    <div class="col-sm-3">
                                        {{ $value->rata_rata_kinerja ?? '-' }}
                                    </div>
                                </div>
                                <div class="row text-center" style="background-color:#FFF; padding: 5px;">
                                    <div class="col-sm-3">
                                        KD4
                                    </div>
                                    <div class="col-sm-3">
                                        {{ $kd[4] ?? '-' }}
                                    </div>
                                    <div class="col-sm-3">
                                        Proyek 1
                                    </div>
                                    <div class="col-sm-3">
                                        {{ $value->Proyek1 ?? '-' }}
                                    </div>
                                </div>
                                <div class="row text-center" style="background-color:#EEE; padding: 5px;">
                                    <div class="col-sm-3">
                                        KD5
                                    </div>
                                    <div class="col-sm-3">
                                        {{ $kd[5] ?? '-' }}
                                    </div>
                                    <div class="col-sm-3">
                                        Proyek 2
                                    </div>
                                    <div class="col-sm-3">
                                        {{ $value->Proyek2 ?? '-' }}
                                    </div>
                                </div>
                                <div class="row text-center" style="background-color:#FFF; padding: 5px;">
                                    <div class="col-sm-3">
                                        KD6
                                    </div>
                                    <div class="col-sm-3">
                                        {{ $kd[6] ?? '-' }}
                                    </div>
                                    <div class="col-sm-3">
                                        Rata-rata Proyek
                                    </div>
                                    <div class="col-sm-3">
                                        {{ $value->rata_rata_proyek ?? '-' }}
                                    </div>
                                </div>
                                <div class="row text-center" style="background-color:#EEE; padding: 5px;">
                                    <div class="col-sm-3">
                                        KD7
                                    </div>
                                    <div class="col-sm-3">
                                        {{ $kd[7] ?? '-' }}
                                    </div>
                                    <div class="col-sm-3">
                                        Portofolio1
                                    </div>
                                    <div class="col-sm-3">
                                        {{ $value->portofolio1 ?? '-' }}
                                    </div>
                                </div>
                                <div class="row text-center" style="background-color:#FFF; padding: 5px;">
                                    <div class="col-sm-3">
                                        KD8
                                    </div>
                                    <div class="col-sm-3">
                                        {{ $kd[8] ?? '-' }}
                                    </div>
                                    <div class="col-sm-3">
                                        Portofolio2
                                    </div>
                                    <div class="col-sm-3">
                                        {{ $value->portofolio2 ?? '-' }}
                                    </div>
                                </div>
                                <div class="row text-center" style="background-color:#EEE; padding: 5px;">
                                    <div class="col-sm-3">
                                        KD9
                                    </div>
                                    <div class="col-sm-3">
                                        {{ $kd[9] ?? '-' }}
                                    </div>
                                    <div class="col-sm-3">
                                        Rata-rata Portofolio
                                    </div>
                                    <div class="col-sm-3">
                                        {{ $value->rata_rata_portofolio ?? '-' }}
                                    </div>
                                </div>
                                <div class="row text-center" style="background-color:#FFF; padding: 5px;">
                                    <div class="col-sm-3">
                                        KD10
                                    </div>
                                    <div class="col-sm-3">
                                        {{ $kd[10] ?? '-' }}
                                    </div>
                                </div>

                                <div class="row text-center" style="background-color:#EEE; padding: 5px;">
                                    <div class="col-sm-3">
                                        Rata-rata KD
                                    </div>
                                    <div class="col-sm-3">
                                        {{ $value->rata_rata_kd ?? '-' }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row text-center" style="padding: 5px; margin-top:10px;">
                                    <div class="col-sm-4">
                                        PTS
                                    </div>
                                    <div class="col-sm-4">
                                        PAS
                                    </div>
                                    <div class="col-sm-4">
                                        Nilai Raport Pengetahuan
                                    </div>
                                </div>
                                <div class="row text-center" style="padding: 5px; margin-top:10px;">
                                    <div class="col-sm-4">
                                        {{ $value->pts ?? '-' }}
                                    </div>
                                    <div class="col-sm-4">
                                        {{ $value->pas ?? '-' }}
                                    </div>
                                    <div class="col-sm-4">
                                        {{ $value->n_raport_pengetahuan ?? '-' }}
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div> --}}
                        </div>
    
                    </div>
            </tr>
            @endforeach
        </table>
        @endif
    </div>
</div>
@endsection