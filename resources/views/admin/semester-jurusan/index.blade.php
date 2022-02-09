@extends('admin.templates.template')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('title')
<h1>
    Semester Akademik {{ $semester->nama_semester }}
    <small>Control panel</small>
</h1>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Semester Akademik {{ $semester->nama_semester }}</li>
</ol>
@endsection
@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Daftar Semester Jurusan pada Semester Akademik {{ $semester->nama_semester }}</h3>
        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i> Tambah</button>
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('semester-jur.store', $semester->id) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">Tambah Semester Jurusan</h4>
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
                                <label for="tanggal_mulai_semester">Tanggal Mulai Pembelajaran</label>
                                <input type="date" class="form-control" id="tanggal_mulai_semester" name="tanggal_mulai_semester" placeholder="[Tanggal Mulai Pembelajaran]">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_selesai_semester">Tanggal Selesai Pembelajaran</label>
                                <input type="date" class="form-control" id="tanggal_selesai_semester" name="tanggal_selesai_semester" placeholder="[Tanggal Selesai Pembelajaran]">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_mulai_input_nilai">Mulai Input Nilai</label>
                                <input type="date" class="form-control" id="tanggal_mulai_input_nilai" name="tanggal_mulai_input_nilai" placeholder="[Mulai Input Nilai]">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_selesai_input_nilai">Selesai Input Nilai</label>
                                <input type="date" class="form-control" id="tanggal_selesai_input_nilai" name="tanggal_selesai_input_nilai" placeholder="[Selesai Input Nilai]">
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
                    <th>Tanggal Mulai Pembelajaran</th>
                    <th>Tanggal Selesai Pembelajaran</th>
                    <th>Mulai Input Nilai</th>
                    <th>Selesai Input Nilai</th>
                    <th>Status</th>
                    <th style="width: 200px">Pilihan</th>
                </tr>
            </thead>
            @foreach ($semesterJurusan as $key => $value )
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $value->jurusan->nama }}</td>
                <td>{{ $value->tanggal_mulai_semester }}</td>
                <td>{{ $value->tanggal_selesai_semester }}</td>
                <td>{{ $value->tanggal_mulai_input_nilai }}</td>
                <td>{{ $value->tanggal_selesai_input_nilai }}</td>
                <td><i class="fa fa-{{ $value->status_aktif == 1 ? 'check' : 'ban'}}"></i> {{ $value->status_aktif == 1 ? 'Aktif' : 'Tidak Aktif'}}</td>
                <td>
                    <form action="{{ route('semester-jur.status', [$semester->id ,$value->id]) }}" method="POST" style="display: inline">
                        @csrf
                        @method('put')
                        <button class="btn btn-sm {{ $value->status_aktif == 1 ? 'bg-black' : 'bg-green' }}" onclick="return confirm('Yakin ingin {{ $value->status_aktif == 1 ? 'menonaktifkan' : 'mengaktifkan' }} semester {{ $value->jurusan->nama }}?')"> {!! ($value->status_aktif == 1) ? 'Nonaktifkan!' : 'Aktifkan!' !!}</button>
                    </form>
                    <form action="{{ route('semester-jur.delete', [$semester->id ,$value->id]) }}" method="POST" style="display: inline">
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