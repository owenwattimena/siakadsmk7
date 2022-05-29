@extends('admin.templates.template')
@section('breadcrump')
<h1>
    Dashboard
    <small>{{--Control panel--}}</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
    <li class="active">Kelas Peserta</li>

</ol>
@endsection
@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Setting Semester Aktif</h3>

            </div><!-- /.box-header -->
            <div class="box-header">
                @inject('serviceKelas', 'App\Services\Kelas')
                <h3 class="box-title">@if( ! empty($kelaspeserta[0]['mkkurKode'])) {{$kelaspeserta[0]['mkkurKode'].' - '.$kelaspeserta[0]['mkkurNama'].' - Kelas '. $serviceKelas->kelasSemester($kelaspeserta[0]['klsNama']) }} @endif</h3>
            </div>
            <div class="box-body flash-message">
                @if (session('success'))
                <div class="alert alert-info">
                    <strong>{{ session('success') }}</strong>
                </div>
                @elseif (session('error'))
                <div class="alert alert-error">
                    <strong>{{ session('error') }}</strong>
                </div>
                @endif
            </div>
            <div class="box-body">
                <form action="{{ route('dashboard-guru.import-nilai', $kelasId) }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td colspan="2">
                                    1. Gunakan Tombol "Download Peserta Kelas" untuk mendownload format file Upload.<br>
                                    2. Upload file dalam ekstensi *.xlsx, *.xls, *.csv dan format sesuai dengan format file yang didownload.
                                </td>

                            </tr>
                            <tr>
                                <td width="250px"><input class="btn " type="file" name="import_file" required accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" /></td>
                                <td align="left"><button class="btn btn-primary" type="submit">Import Nilai</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="klsId" value="{{ $kelasId }}">
                </form>

            </div>
            <div class="box-body">
                <p><strong>Download form nilai untuk peserta kelas matakuliah.</strong></p>
                <div class="btn-group">
                    <a href="{{ route('dashboard-guru.peserta-download', $kelasId) }}"><button type="button" class="btn btn-flat btn-success">Download Peserta Kelas</button></a>
                    {{-- <button aria-expanded="true" type="button" class="btn btn-flat btn-success dropdown-toggle" data-toggle="dropdown">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="">Tipe file <b>*.xlsx</b></a></li>
                          <li><a href="">Tipe file <b>*.xls</b></a></li>
                          <li class="divider"></li>
                          <li><a href="">Tipe file <b>*.csv</b></a></li>
                          
                        </ul> --}}
                </div>
            </div>
            <div class="box-body col-md-12" align="right">
                <a href="{{ route('dashboard-guru.nilai-kelas', [$kelasId, 'cetak'=>false]) }}" class="btn btn-flat btn-warning" value="Download Nilai Semester"><i class="fa fa-download"></i> Download</a>
                {{-- <a href="{{ route('dashboard-guru.nilai-kelas', [$kelasId, 'cetak'=>true]) }}" class="btn btn-flat btn-info" value="Cetak Nilai Semester"><i class="fa fa-print"></i> Cetak</a> --}}
            </div>

            <div class="box-body">
                <table id="dataKurikulum" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>N. Raport Pengetahuan</th>
                            <th>Predikat Pengetahuan</th>
                            <th>N. Raport Ketrampilan</th>
                            <th>Predikat Ketrampilan</th>
                            <th>Pilihan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (! empty($peserta))
                        <?php $i=1;foreach ($peserta as $key => $value):  ?>
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$value->nis}}</td>
                            <td>{{$value->nama}}</td>
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
                                                    {{ $peserta->first()->mapel }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label>Kelas</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    {{ $serviceKelas->kelasSemester($peserta->first()->paket_semester,$peserta->first()->nama_kelas) }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label>Semester</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    {{ ($peserta->first()->paket_semester%2 == 0 ? 'Genap' : 'Ganjil') }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label>Tahun Pelajaran</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    {{ $peserta->first()->tahun_pelajaran }}
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
                        <?php $i++; endforeach  ?>
                        @endif
                    </tbody>

                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->

    </div><!-- /.col -->
</div><!-- /.row -->

@endsection
@section('script')

@endsection
