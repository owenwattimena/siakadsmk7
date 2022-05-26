@extends('admin.templates.template')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('title')
<h1>
    Kurikulum
    <small>{{--Control panel--}}</small>
</h1>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Kurikulum</li>
</ol>
@endsection
@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Daftar Kurikulum</h3>
        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i> Tambah</button>
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('kurikulum.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">Tambah Kurikulum</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="jurusan_kode">Nama Jurusan</label>
                                <select class="form-control" id="jurusan_kode" name="jurusan_kode">
                                    @foreach ($jurusan as $item)
                                    <option value="{{ $item->kode }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tahun">Tahun</label>
                                <input type="number" class="form-control" id="tahun" name="tahun" placeholder="[Tahun]">
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="[Nama]">
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
                    <th>Jurusan</th>
                    <th>Tahun</th>
                    <th>Nama</th>
                    <th style="width: 350px">Pilihan</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($kurikulum as $key => $value )
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $value->jurusan->nama }}</td>
                    <td>{{ $value->tahun }}</td>
                    <td>[{{ $value->id }}]{{ $value->nama }}</td>
                    <td>
                        <a href="{{ route('mapel-kurikulum.main', $value->id) }}" class="btn btn-sm bg-blue"> <i class="fa fa-list"></i> Matapelajaran</a>
                        <button class="btn btn-sm bg-orange" data-toggle="modal" data-target="#modal-default-{!! $key !!}"> <i class="fa fa-pencil"></i> Ubah</button>
                        @if (count($value->matapelajaran) <= 0)
                        <form action="{{ route('kurikulum.delete', $value->id) }}" method="POST" style="display: inline">
                            @csrf
                            @method('delete')
                            <button class="btn btn-sm bg-red" onclick="return confirm('Yakin ingin menghapus kurikulum {{ $value->nama }}?')"> <i class="fa fa-trash"></i> Hapus</button>
                        </form>
                        @endif
                    </td>
                </tr>
                <div class="modal fade" id="modal-default-{!! $key !!}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('kurikulum.update', $value->id) }}" method="POST">
                                @csrf
                                @method('put')
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="modal-title">Ubah Kurikulum</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="jurusan_kode">Nama Jurusan</label>
                                        <select class="form-control" id="jurusan_kode" name="jurusan_kode">
                                            @foreach ($jurusan as $item)
                                            <option value="{{ $item->kode }}" {{ ($value->jurusan_kode == $item->kode ? 'selected' : '') }}>{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tahun">Tahun</label>
                                        <input type="number" class="form-control" id="tahun" name="tahun" value="{{ $value->tahun }}" placeholder="[Tahun]">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $value->nama }}" placeholder="[Nama]">
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
    $('#table').DataTable()
</script>
@endsection