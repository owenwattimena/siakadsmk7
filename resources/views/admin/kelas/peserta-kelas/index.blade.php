@extends('admin.templates.template')
@section('title')
<h1>
    Registrasi Kelas Semester
    <small>Control panel</small>
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
            <h3>{{ $peserta->first()->mapel_kuri_id }}-{{ $peserta->first()->mapel }} | Kelas {{ $peserta->first()->nama_kelas }}</h3>
            <form action="{{ route('nilai.import', $kelasId) }}" class="form-horizontal" method="post" enctype="multipart/form-data">
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
            <a href="{{ route('nilai.unduh-peserta', $kelasId) }}" class="btn btn-primary margin">Unduh Peserta Kelas</a>
            <table class="table table-condensed">
                <tr>
                    <th style="width: 10px">#</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Nilai Pengetahuan</th>
                    <th>Nilai Keterampilan</th>
                    <th>Nilai Akhir</th>
                    <th>Bobot Nilai</th>
                    <th>Nilai Huruf</th>
                </tr>
                @foreach ($peserta as $key => $value )
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $value->nis }}</td>
                    <td>{{ $value->nama }}</td>
                    <td>{{ $value->nilai_pengetahuan ?? '-' }}</td>
                    <td>{{ $value->nilai_ketrampilan ?? '-' }}</td>
                    <td>{{ $value->nilai_akhir ?? '-' }}</td>
                    <td>{{ $value->bobot_nilai ?? '-' }}</td>
                    <td>{{ $value->nilai_huruf ?? '-' }}</td>
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