@extends('admin.templates.template')
@section('title')
<h1>
    Nilai
    <small>Control panel</small>
</h1>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ route('dashboard-siswa') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><i class="fa fa-dashboard"></i> Nilai</li>
</ol>
@endsection

@section('content')

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
            <a href="{{ route('dashboard-siswa.donwload-nilai', [$semesterId, 'cetak' => true],) }}" class="btn btn-flat btn-info" value="Cetak Nilai Semester"><i class="fa fa-print"></i> Cetak</a>
          </div>
        <table class="table table-condensed">
            <tr>
                <th style="width: 10px">#</th>
                <th>Matapelajaran</th>
                <th>Nilai Pengetahuan</th>
                <th>Nilai Keterampilan</th>
                <th>Nilai Akhir</th>
                <th>Predikat</th>
            </tr>
            @foreach ($dataBelajar as $key => $value )
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $value->nama }}</td>        
                <td>{{ $value->nilai_pengetahuan }}</td>
                <td>{{ $value->nilai_ketrampilan }}</td>
                <td>{{ $value->nilai_akhir }}</td>
                <td>{{ $value->predikat }}</td>
            </tr>
            @endforeach
        </table>
        @endif
    </div>
</div>
@endsection