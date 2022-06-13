@extends('admin.templates.template')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('title')
<h1>
    Tugas Kelas
    @inject('serviceKelas', 'App\Services\Kelas')
    <small>{{ $kelas->nama_mapel }} {{ $serviceKelas->kelasSemester($kelas->semester, $kelas->nama) }}</small>
</h1>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
</ol>
@endsection

@section('content')
<div>
    <div class="box">
        <div class="box-header">
            Daftar Tugas
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default">Tambah</button>
            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('dashboard-guru.kelas-tugas.create', $kelasId) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title">Tambah Tugas</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="judul">Judul</label>
                                    <input type="text" class="form-control" id="judul" name="judul" placeholder="[Judul Tugas]">
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="[Keterangan Tugas]">
                                </div>
                                <div class="form-group">
                                    <label for="file">File</label>
                                    <input type="file" class="form-control" id="file" name="file" placeholder="[File]">
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
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table id="table" class="table">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Tugas</th>
                            <th>Keterangan</th>
                            <th>File</th>
                            <th>Pilihan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tugas as $key => $item)
                        @php
                        $file = explode('/', $item->file);
                        $file = 'storage/tugas/'.end($file);
                        @endphp
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>
                                @if ($item->file!=null)
                                    <a href="{{ asset($file) }}" target="_blank">Link File</a>
                                @else
                                    {!! "-" !!}
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-default-{!! $key !!}"><i class="fa fa-pencil"></i> Ubah</button>
                                <a href="{{ route('dashboard-guru.kelas-tugas.detail', [$kelasId, $item->id]) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Detail</a>
                                <form action="{{ route('dashboard-guru.kelas-tugas.delete', [$kelasId, $item->id]) }}" method="post" style="display: inline">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm" onclick="confirm('Yakin ingin menghapus Tugas?')"><i class="fa fa-trash"></i> Hapus</button>
                                </form>
                            </td>
                        </tr>
                        <div class="modal fade" id="modal-default-{!! $key !!}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('dashboard-guru.kelas-tugas.update', $kelasId) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="id_tugas" value="{{ $item->id }}">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h4 class="modal-title">Ubah Tugas</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="judul">Judul</label>
                                                <input type="text" class="form-control" id="judul" name="judul" value="{{ $item->judul }}" placeholder="[Judul Tugas]">
                                            </div>
                                            <div class="form-group">
                                                <label for="keterangan">Keterangan</label>
                                                <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ $item->keterangan }}" placeholder="[Keterangan Tugas]">
                                            </div>
                                            <div class="form-group">
                                                <label for="file">File</label>
                                                <input type="file" class="form-control" id="file" name="file" placeholder="[File]">
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
        </div>
    </div>
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
