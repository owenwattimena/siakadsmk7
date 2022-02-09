@extends('admin.templates.template')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('title')
<h1>
    Pengumuman Kelas
    <small>Control panel</small>
</h1>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="#"><i class="fa fa-list"></i> Kelas</a></li>
    <li class="active">Pengumuman</li>
</ol>
@endsection
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Pengumuman Kelas {{ $mapel }}</h3>
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i> Buat</button>
            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('dashboard-guru.kelas-pengumuman-store', $idKelas) }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title">Buat Pengumuman</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="judul">Judul</label>
                                    <input type="text" class="form-control" id="judul" name="judul" placeholder="[Judul]">
                                </div>
                                <div class="form-group">
                                    <label for="isi">Isi Pengumuman</label>
                                    <textarea class="form-control" id="isi" name="isi" placeholder="[Isi Pengumuman]"></textarea>
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
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
                            <th style="width: 50px">#</th>
                            <th>Judul</th>
                            <th>Isi</th>
                            <th style="width: 150px">Pilihan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($pengumuman as $item)
                            
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>{{ $item->isi }}</td>
                                <td>
                                    <button onclick="return setValue(`{{ $item->id }}`, `{{ $item->judul }}`, `{{ $item->isi }}`)" class="btn btn-sm bg-yellow" data-toggle="modal" data-target="#modal-default-edit"><i class="fa fa-edit"></i> Edit</button>                                      
                                    <form action="{{ route('dashboard-guru.kelas-pengumuman-delete',[$idKelas,$item->id]) }}" method="POST" style="display: inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm bg-red" onclick="return confirm('Yakin ingin menghapus pengumuman {{ $item->judul }}?')"> <i class="fa fa-trash"></i> Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @php
                                $no++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-default-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('dashboard-guru.kelas-pengumuman-update', $idKelas) }}" method="POST">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" id="id-edit">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Edit Pengumuman</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" id="judul-edit" name="judul" placeholder="[Judul]">
                        </div>
                        <div class="form-group">
                            <label for="isi">Isi Pengumuman</label>
                            <textarea class="form-control" id="isi-edit" name="isi" placeholder="[Isi Pengumuman]"></textarea>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('script')
{{-- Datatable --}}
<script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script>
    $('#table').DataTable({
        "pageLength": 50
    });
    function setValue(id, judul, isi)
    {
        $('#id-edit').val(id);
        $('#judul-edit').val(judul);
        $('#isi-edit').val(isi);
    }
</script>
@endsection

