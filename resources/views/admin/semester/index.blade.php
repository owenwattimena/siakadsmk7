@extends('admin.templates.template')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('title')
<h1>
    Semester Akademik
    <small>Control panel</small>
</h1>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Semester Akademik</li>
</ol>
@endsection
@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Daftar Semester Akademik</h3>
        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i> Tambah</button>
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('semester.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">Tambah Semester</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama">Nama Semester</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="[Nama Semester]">
                                @error('nama')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tanggal_mulai">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" placeholder="[Tanggal Mulai]">
                                @error('nama')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tanggal_selesai">Tanggal Selesai</label>
                                <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" placeholder="[Tanggal Selesai]">
                                @error('nama')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tahun">Tahun Pelajaran</label>
                                <input type="text" class="form-control" id="tahun" name="tahun" placeholder="[Tahun/Tahun]">
                                @error('tahun')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="jenis_semester">Ganjil/Genap</label>
                                <select class="form-control" id="jenis_semester" name="jenis_semester">
                                    <option value="1">Ganjil</option>
                                    <option value="2">Genap</option>
                                </select>
                                @error('jenis_semester')
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
        <table id="table"class="table table-condensed">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Semester</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Tahun Ajaran</th>
                    <th>Jenis Semester</th>
                    <th>Status</th>
                    <th style="width: 350px">Pilihan</th>
                </tr>
            </thead>
            @foreach ($semester as $key => $value )
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $value->nama_semester }}</td>
                <td>{{ $value->tanggal_mulai }}</td>
                <td>{{ $value->tanggal_selesai }}</td>
                <td>{{ $value->tahun_pelajaran}}</td>
                <td>{{ ($value->jenis_semester % 2 == 0) ? 'Genap' : 'Ganjil'}}</td>
                <td><i class="fa fa-{{ $value->is_aktif == 1 ? 'check' : 'ban'}}"></i> {{ $value->is_aktif == 1 ? 'Aktif' : 'Tidak Aktif'}}</td>
                <td>
                    <a href="{{ route('semester-jur.main', $value->id) }}" class="btn btn-sm bg-blue" > Semester Jurusan</a>
                    <form action="{{ route('semester.status', $value->id) }}" method="POST" style="display: inline">
                        @csrf
                        @method('put')
                        <button class="btn btn-sm {{ $value->is_aktif == 1 ? 'bg-black' : 'bg-green' }}" onclick="return confirm('Yakin ingin {{ $value->is_aktif == 1 ? 'menonaktifkan' : 'mengaktifkan' }} semester {{ $value->nama_semester }}?')"> {!! ($value->is_aktif == 1) ? 'Nonaktifkan!' : 'Aktifkan!' !!}</button>
                    </form>
                    <form action="{{ route('semester.delete', $value->id) }}" method="POST" style="display: inline">
                        @csrf
                        @method('delete')
                        <button class="btn btn-sm bg-red" onclick="return confirm('Yakin ingin menghapus semester {{ $value->nama_semester }}?')"> <i class="fa fa-trash"></i> Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
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
</script>
@endsection