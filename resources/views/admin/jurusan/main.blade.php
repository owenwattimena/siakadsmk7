@extends('admin.templates.template')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('title')
<h1>
    Jurusan
    <small>Control panel</small>
</h1>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Jurusan</li>
</ol>
@endsection
@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Daftar Jurusan</h3>
        {{-- <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i> Tambah</button> --}}
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('jurusan.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">Tambah Jurusan</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama">Nama Jurusan</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="[Nama Jurusan]">
                            </div>
                            <div class="form-group">
                                <label for="kode">Kode Jurusan</label>
                                <input type="text" class="form-control" id="kode" name="kode" placeholder="[Kode Jurusan]">
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
        <table class="table table-condensed" id="table">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Jurusan</th>
                    <th>Kode Jurusan</th>
                    <th style="width: 150px">Pilihan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jurusan as $key => $value )
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>[{{ $value->id }}]{{ $value->nama }}</td>
                    <td>{{ $value->kode }}</td>
                    <td>
                        <button class="btn btn-sm bg-orange" data-toggle="modal" data-target="#modal-default-{!! $key !!}"> <i class="fa fa-pencil"></i> Ubah</button>
                        @if (count($value->kurikulum) <= 0)
                        <form action="{{ route('jurusan.delete', $value->id) }}" method="POST" style="display: inline">
                            @csrf
                            @method('delete')
                            <button class="btn btn-sm bg-red" onclick="return confirm('Yakin ingin menghapus jurusan {{ $value->kode }}?')"> <i class="fa fa-trash"></i> Hapus</button>
                        </form>
                        @endif
                    </td>
                </tr>
                <div class="modal fade" id="modal-default-{!! $key !!}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('jurusan.update', $value->id) }}" method="POST">
                                @csrf
                                @method('put')
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="modal-title">Ubah Jurusan</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nama">Nama Jurusan</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $value->nama }}" placeholder="[Nama Jurusan]">
                                    </div>
                                    <div class="form-group">
                                        <label for="kode">Kode Jurusan</label>
                                        <input type="text" class="form-control" id="kode" name="kode" value="{{ $value->kode }}" placeholder="[Kode Jurusan]">
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
