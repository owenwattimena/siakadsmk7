@extends('admin.templates.template')
@section('title')
<h1>
    Tugas
    {{-- <small>Control panel</small> --}}
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
            Tugas
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table id="table" class="table">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>MATA PELAJARAN</td>
                            <td>GURU</td>
                            <td>JUDUL</td>
                            <td>KETERANGAN</td>
                            <td>FILE</td>
                            <td>STATUS</td>
                            <td>PILIHAN</td>
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
                            <td>{{ $item->mapel }}</td>
                            <td>{{ $item->guru }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>
                                @if ($item->file!=null)
                                <a href="{{ asset($file) }}">Link File</a>
                                @else{!! "-" !!}
                                @endif
                            </td>
                            <td>{!! $item->status <= 0 ? '<span class="badge bg-red">Belum Di kerjakan</span>' : '<span class="badge bg-green">Sudah Di kerjakan</span>' !!}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-default-{!! $key !!}"><i class="fa fa-upload"></i> Unggah</button>
                            </td>
                        </tr>
                        <div class="modal fade" id="modal-default-{!! $key !!}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('dashboard-siswa.tugas-unggah') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('post')
                                        <input type="hidden" name="id_tugas" value="{{ $item->id }}">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h4 class="modal-title">Unggah Tugas</h4>
                                        </div>
                                        <div class="modal-body">
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection