@extends('admin.templates.template')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('title')
<h1>
    Guru
    <small>{{--Control panel--}}</small>
</h1>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Guru</li>
</ol>
@endsection
@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Daftar Guru</h3>
        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i> Tambah</button>
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('guru.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">Tambah Guru</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="jurusan">Jurusan</label>
                                <select class="form-control" id="jurusan" name="jurusan_id">
                                    @foreach ($jurusan as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nign">Nomor Guru</label>
                                <input type="text" class="form-control" id="nign" name="nign" placeholder="[Nomor Guru]">
                                @error('nign')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nip">Nomor Induk Pegawai (NIP)</label>
                                <input type="number" class="form-control" id="nip" name="nip" placeholder="[Nomor Induk Pegawai]">
                                @error('nip')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama Guru</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="[Nama Guru]">
                                @error('nama')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="[Email]">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
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
                    <th>No Guru</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jurusan</th>
                    <th style="width: 200px">Pilihan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($guru as $key => $value )
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $value->nign }}</td>
                    <td>{{ $value->nip ?? '-' }}</td>
                    <td>{{ $value->nama }}</td>
                    <td>{{ $value->user->email ?? '-' }}</td>
                    <td>{{ $value->jurusan->nama }}</td>
                    <td>
                        <button class="btn btn-sm bg-orange" data-toggle="modal" data-target="#modal-default-{!! $key !!}"> <i class="fa fa-pencil"></i> Ubah</button>
                        <form action="{{ route('guru.delete', $value->id) }}" method="POST" style="display: inline">
                            @csrf
                            @method('delete')
                            <button class="btn btn-sm bg-red" onclick="return confirm('Yakin ingin menghapus guru {{ $value->nama }}?')"> <i class="fa fa-trash"></i> Hapus</button>
                        </form>
                    </td>
                </tr>
                <div class="modal fade" id="modal-default-{!! $key !!}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('guru.update', $value->id) }}" method="POST">
                                @csrf
                                @method('put')
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="modal-title">Ubah Guru</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="jurusan">Jurusan</label>
                                        <select class="form-control" id="jurusan" name="jurusan_id" disabled>
                                            @foreach ($jurusan as $item)
                                                <option {{ $item->id == $value->jurusan_id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nign">No Guru</label>
                                        <input type="number" class="form-control" id="nign" name="nign" value="{{ $value->nign }}" placeholder="[Nomor Induk Guru Nasional]" readonly>
                                        @error('nign')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="nip">Nomor Induk Pegawai (NIP)</label>
                                        <input type="number" class="form-control" id="nip" name="nip" value="{{ $value->nip }}" placeholder="[Nomor Induk Pegawai]" readonly>
                                        @error('nip')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama Guru</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $value->nama }}" placeholder="[Nama Guru]">
                                        @error('nama')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $value->user->email }}" placeholder="[Email]">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
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
<script type="text/javascript">
    $('#table').DataTable({
        "pageLength": 50
    })
    $(window).on('load', function() {
        var errors = `{{ $errors->any() }}`; 
        if(errors){
            $('#modal-default').modal('show');
        }
    });
</script>    
@endsection