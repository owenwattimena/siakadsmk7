@extends('admin.templates.template')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('title')
<h1>
    Galeri
    {{-- <small>Control panel</small> --}}
</h1>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Dashboard</li>
    <li class="active"><i class="fa fa-photo"></i> Galeri</li>
</ol>
@endsection

@section('content')
<div>
    <div class="box">
        <div class="box-header">
            <div class="box-title">Galeri</div>
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i> Tambah</button>
            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('galeri') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title">Galeri</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="foto">Foto</label>
                                    <input type="file" class="form-control" id="foto" name="foto" accept="image/png, image/gif, image/jpeg">
                                    @error('foto')
                                        <small class="text-red">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
                                    @error('deskripsi')
                                        <small class="text-red">{{ $message }}</small>
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
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table id="table" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width: 15px">#</th>
                            <th style="width: 100px">Foto</th>
                            <th>Deskripsi</th>
                            <th>Pilihan</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $no = 1;
                    @endphp
                        @foreach ($galeri as $item)
                        @php
                            $itemFoto = explode('/', $item->foto);
                            $foto = 'storage/galeri/'.end($itemFoto);
                        @endphp
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td class="text-center"><img src="{{ asset($foto) }}" alt="" width="100"></td>
                                <td>{{ $item->deskripsi_galeri }}</td>
                                <td>UBAH|HAPUS</td>
                            </tr>
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
