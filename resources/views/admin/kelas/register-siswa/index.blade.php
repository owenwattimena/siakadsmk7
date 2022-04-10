@extends('admin.templates.template')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('title')
<h1>
    Registrasi Siswa Semester
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
<div class="text-right margin">
    <form action="{{ route('kelas.register-siswa-semester') }}" method="post">
        @csrf
        <button type="submit"class="btn btn-primary">Registrasikan Siswa Semester Aktif</button>
    </form>
</div>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Daftar Siswa Teregistrasi Pada Semester Aktif</h3>
        <!-- /.modal -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="table" class="table table-condensed">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Tahun Semester</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Angkatan</th>
                    <th>Jurusan</th>
                    <th>Kelas</th>
                    <th>Paket Semester</th>
                </tr>
            </thead>
            @foreach ($kelas as $key => $value )
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $value->nama_semester }}</td>
                <td>{{ $value->nis }}</td>
                <td>{{ $value->nama }}</td>
                <td>{{ $value->angkatan }}</td>
                <td>{{ $value->kode }}</td>
                <td> <button class="btn btn-sm btn-primary">
                    {{ ($value->paket_semester == 1 || $value->paket_semester  == 2) ? 'X' : '' }}
                    {{ $value->kelompok }}
                </button></td>
                <td>{{ $value->paket_semester }}</td>
                
            </tr>
            {{-- <div class="modal fade" id="modal-default-{!! $key !!}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('siswa.update', $value->id) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title">Ubah Siswa</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="jurusan">Jurusan</label>
                                    <select class="form-control" id="jurusan" name="jurusan_kode" disabled>
                                        @foreach ($jurusan as $item)
                                            <option {{ $item->id == $value->jurusan_id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nis">NIS</label>
                                    <input type="number" class="form-control" id="nis" name="nis" value="{{ $value->nis }}" placeholder="[Nomor Induk Siswa]" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $value->nama }}" placeholder="[Nama Siswa]">
                                </div>
                                <div class="form-group">
                                    <label for="angkatan">Angkatan</label>
                                    <input type="number" min="2010" max="2110" class="form-control" id="angkatan" name="angkatan" value="{{ $value->angkatan }}" placeholder="[Angkatan]">
                                </div>
                                <div class="form-group">
                                    <label for="kelompok">Kelompok</label>
                                    <input type="text" class="form-control" id="kelompok" name="kelompok" value="{{ $value->kelompok }}" placeholder="[Kelompok]">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $value->user->email }}" placeholder="[Email]">
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
            </div> --}}
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