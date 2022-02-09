@extends('admin.templates.template')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('title')
<h1>
    Siswa
    <small>Control panel</small>
</h1>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Siswa</li>
</ol>
@endsection
@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Daftar Siswa</h3>
        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i> Tambah</button>
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('siswa.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">Tambah Siswa</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="jurusan">Jurusan</label>
                                <select class="form-control" id="jurusan" name="jurusan_kode">
                                    @foreach ($jurusan as $item)
                                        <option value="{{ $item->kode }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nis">NIS</label>
                                <input type="number" class="form-control" id="nis" name="nis" placeholder="[Nomor Induk Siswa]">
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="[Nama Siswa]">
                            </div>
                            <div class="form-group">
                                <label for="angkatan">Angkatan</label>
                                <input type="number" min="2010" max="2110" class="form-control" id="angkatan" name="angkatan" placeholder="[Angkatan]">
                            </div>
                            <div class="form-group">
                                <label for="kelompok">Kelas</label>
                                <input type="text" class="form-control" id="kelompok" name="kelompok" placeholder="[Kelompok]">
                            </div>
                            <div class="form-group">
                                <label for="kurikulum_id">Kurikulum Yang Diikuti</label>
                                <select class="form-control" id="kurikulum_id" name="kurikulum_id">
                                    @foreach ($kurikulum as $itemKurikulum)
                                        <option value="{{ $itemKurikulum->id }}">{{ $itemKurikulum->nama }} - {{ $itemKurikulum->jurusan_kode }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="[Email]">
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
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jurusan</th>
                    <th>Angkatan</th>
                    <th>Kelas</th>
                    <th>Status</th>
                    <th style="width: 250px">Pilihan</th>
                </tr>
            </thead>
            @foreach ($siswa as $key => $value )
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $value->nis }}</td>
                <td>{{ $value->nama }}</td>
                <td>{{ $value->user->email }}</td>
                <td>{{ $value->jurusan->nama }}</td>
                <td>{{ $value->angkatan }}</td>
                <td>{{ $value->kelompok }}</td>
                <td><i class="fa fa-{{ $value->status_aktif == 1 ? 'check' : 'ban'}}"></i> {{ $value->status_aktif == 1 ? 'Aktif' : 'Tidak Aktif'}}</td>
                <td>
                    <button class="btn btn-sm bg-orange" data-toggle="modal" data-target="#modal-default-{!! $key !!}"> <i class="fa fa-pencil"></i> Ubah</button>
                    <form action="{{ route('siswa.status', $value->id) }}" method="POST" style="display: inline">
                        @csrf
                        @method('put')
                        <button class="btn btn-sm {{ $value->status_aktif == 1 ? 'bg-black' : 'bg-green' }}" onclick="return confirm('Yakin ingin {{ $value->status_aktif == 1 ? 'menonaktifkan' : 'mengaktifkan' }} siswa {{ $value->nama }}?')"> {!! ($value->status_aktif == 1) ? 'Nonaktifkan!' : 'Aktifkan!' !!}</button>
                    </form>
                    <form action="{{ route('siswa.delete', $value->id) }}" method="POST" style="display: inline">
                        @csrf
                        @method('delete')
                        <button class="btn btn-sm bg-red" onclick="return confirm('Yakin ingin menghapus siswa {{ $value->nama }}?')"> <i class="fa fa-trash"></i> Hapus</button>
                    </form>
                </td>
            </tr>
            <div class="modal fade" id="modal-default-{!! $key !!}">
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
                                    <input type="number" disabled min="2010" max="2110" class="form-control" id="angkatan" name="angkatan" value="{{ $value->angkatan }}" placeholder="[Angkatan]">
                                </div>
                                <div class="form-group">
                                    <label for="kelompok">Kelas</label>
                                    <input type="text" class="form-control" id="kelompok" name="kelompok" value="{{ $value->kelompok }}" placeholder="[Kelompok]">
                                </div>
                                <div class="form-group">
                                    <label for="kurikulum_id">Kurikulum Yang Diikuti</label>
                                    <select class="form-control" id="kurikulum_id" name="kurikulum_id">
                                        @php
                                            $kurikulumSiswa = collect($kurikulum)->where('jurusan_kode', '=', $value->jurusan_kode)->all();
                                        @endphp
                                        @foreach ($kurikulumSiswa as $itemKurikulum)
                                            <option value="{{ $itemKurikulum->id }}">{{ $itemKurikulum->nama }}</option>
                                        @endforeach
                                    </select>
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
            </div>
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