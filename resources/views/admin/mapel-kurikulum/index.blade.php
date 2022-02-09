@extends('admin.templates.template')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('title')
<h1>
    Matapelajaran {{ $kurikulum->nama }} - Jurusan {{ $kurikulum->jurusan_kode }}
    <small>Control panel</small>
</h1>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>{{ $kurikulum->nama }}</li>
    <li class="active">Matapelajaran</li>
</ol>
@endsection
@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Daftar Matapelajaran {{ $kurikulum->nama }} - Jurusan {{ $kurikulum->jurusan_kode }}</h3>
        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i> Tambah</button>
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('mapel-kurikulum.store', $kurikulum->id) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">Tambah Matapelajaran</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="kurikulum_id" value="{{ $kurikulum->id }}">
                            <div class="form-group">
                                <label for="kurikulum">Kurikulum</label>
                                <input type="text" class="form-control" id="kurikulum" value="{{ $kurikulum->nama }}" placeholder="[Matapelajaran]" disabled>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="[Matapelajaran]">
                            </div>
                            <div class="form-group">
                                <label for="semester">Semester</label>
                                <input type="number" class="form-control" id="semester" name="semester" placeholder="[Semester]">
                            </div>
                            <div class="form-group">
                                <label for="skm">SKM</label>
                                <input type="number" class="form-control" id="skm" step="any" name="skm" placeholder="[SKM]">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="table" class="table table-condensed">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Nama</th>
                    <th>Semester</th>
                    <th>SKM</th>
                    <th style="width: 150px">Pilihan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($matapelajaran as $key => $value )
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $value->nama }}</td>
                    <td>{{ $value->semester }}</td>
                    <td>{{ $value->skm }}</td>
                    <td>
                        <button class="btn btn-sm bg-orange" data-toggle="modal" data-target="#modal-default-{!! $key !!}"> <i class="fa fa-pencil"></i> Ubah</button>
                        <form action="{{ route('mapel-kurikulum.delete', [ $kurikulum->id,$value->id]) }}" method="POST" style="display: inline">
                            @csrf
                            @method('delete')
                            <button class="btn btn-sm bg-red" onclick="return confirm('Yakin ingin menghapus matapelajaran {{ $value->nama }}?')"> <i class="fa fa-trash"></i> Hapus</button>
                        </form>
                    </td>
                </tr>
                <div class="modal fade" id="modal-default-{!! $key !!}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('mapel-kurikulum.update', [ $kurikulum->id,$value->id]) }}" method="POST">
                                @csrf
                                @method('put')
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="modal-title">Ubah Matapelajaran</h4>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="kurikulum_id" value="{{ $kurikulum->id }}">
                                    <div class="form-group">
                                        <label for="kurikulum">kurikulum</label>
                                        <input type="text" class="form-control" id="kurikulum" name="kurikulum" value="{{ $kurikulum->nama }}" placeholder="[Tahun]" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $value->nama }}" placeholder="[Nama]">
                                    </div>
                                    <div class="form-group">
                                        <label for="semester">Semester</label>
                                        <input type="number" class="form-control" id="semester" name="semester" value="{{ $value->semester }}" placeholder="[Semester]">
                                    </div>
                                    <div class="form-group">
                                        <label for="skm">SKM</label>
                                        <input type="number" class="form-control" id="skm" step="any" name="skm" value="{{ $value->skm }}" placeholder="[SKM]">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
@endsection
@section('script')
<script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<script>
    $('#table').DataTable({
        "pageLength": 50
    })
</script>
@endsection