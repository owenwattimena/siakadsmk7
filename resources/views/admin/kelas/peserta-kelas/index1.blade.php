@extends('admin.templates.template')
@section('title')
<h1>
    Registrasi Kelas Semester
    <small>{{--Control panel--}}</small>
</h1>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Registrasi Siswa Semester</li>
</ol>
@endsection
@section('content')
<div class="margin padding">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Daftar Kelas Teregistrasi Pada Semester Aktif</h3>
            <!-- /.modal -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            @inject('serviceKelas', 'App\Services\Kelas')
            <h3>{{ $peserta->first()->mapel_kuri_id }}-{{ $peserta->first()->mapel }} | Kelas {{ $serviceKelas->kelasSemester($peserta->first()->paket_semester,$peserta->first()->nama_kelas) }} </h3>
            {{-- <form action="{{ route('nilai.import', $kelasId) }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                <table class="table">
                    <tbody>  
                        <tr >
                            <td colspan="2" >
                                1. Gunakan Tombol "Download Peserta Kelas" untuk mendownload format file Upload.<br>
                                2. Upload file dalam ekstensi *.xlsx, *.xls, *.csv dan format sesuai dengan format file yang didownload.
                            </td>
                        </tr>                     
                        <tr>
                            <td width="250px"><input type="file" name="import_file" required /></td>
                            <td align="left"><button type="submit" class="btn btn-primary">Import Nilai</button></td>     
                        </tr>                      
                    </tbody>
                </table>
                @csrf
                <input type="hidden" name="klsId" value="">
            </form>
            <a href="{{ route('nilai.unduh-peserta', $kelasId) }}" class="btn btn-primary margin">Unduh Peserta Kelas</a> --}}
            <table class="table table-condensed">
                <tr>
                    <th style="width: 10px">#</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>N. Raport Pengetahuan</th>
                    <th>Predikat Pengetahuan</th>
                    <th>N. Raport Ketrampilan</th>
                    <th>Predikat Ketrampilan</th>
                    <th>Pilihan</th>
                    {{-- <th>Nilai Akhir</th>
                    <th>Bobot Nilai</th>
                    <th>Nilai Huruf</th> --}}
                </tr>
                @foreach ($peserta as $key => $value )
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $value->nis }}</td>
                    <td>{{ $value->nama }}</td>
                    <td>{{ $value->n_raport_pengetahuan ?? '-' }}</td>
                    <td>{{ $value->predikat_pengetahuan ?? '-' }}</td>
                    <td>{{ $value->n_raport_ketrampilan ?? '-' }}</td>
                    <td>{{ $value->predikat_ketrampilan ?? '-' }}</td>
                    <td>
                        <button class="btn btn-small btn-primary" data-toggle="modal" data-target="#modal-default-{{ $key }}"><i class="fa fa-list"></i> Detail</button>
                    </td>
                    <div class="modal fade" id="modal-default-{{ $key }}">
                        <div class="modal-dialog">
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
                                    @for ($i=1; $i <= 10; $i++)    
                                    <div class="row text-center" style="background-color:{{ $i%2 == 0 ? '#EEE' : '#FFF' }}; padding: 5px;">
                                        <div class="col-sm-6">
                                            KD{{ $i }}
                                        </div>
                                        <div class="col-sm-6" id="kd{{ $i }}">
                                            {{ $kd[$i] ?? '-' }}
                                        </div>
                                    </div>
                                    @endfor
        
                                    <div class="row text-center" style="padding: 5px;">
                                        <div class="col-sm-6">
                                            Rata-rata KD
                                        </div>
                                        <div class="col-sm-6">
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
                    {{--
                    <td>{{ $value->nilai_ketrampilan ?? '-' }}</td>
                    <td>{{ $value->nilai_akhir ?? '-' }}</td>
                    <td>{{ $value->bobot_nilai ?? '-' }}</td>
                    <td>{{ $value->nilai_huruf ?? '-' }}</td> --}}
                    {{-- <td> <span class="label bg-blue">{{ $value->kelas_nama }}</span></td> --}}
                    {{-- <td> <a href="#" class="btn btn-sm bg-black"> <i class="fa fa-list"></i> Peserta</a></td> --}}
                    {{-- <td>{{ $value->paket_semester }}</td> --}}
                    
                </tr>
                @endforeach
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    @endsection
    
    @section('script')
    
    @endsection