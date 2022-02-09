@extends('admin.templates.template')
@section('style')
    {{-- Datatable --}}
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('title')
<h1>
    Registrasi Kelas Semester
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
<div class="margin padding">
    <form action="{{ route('kelas.register-kelas-semester-aktif') }}" method="post" class="form-horizontal">
        @csrf
        <div class="form-group">
            <label for="jurusan_kode" class="col-sm-6 control-label">Pilih Jurusan</label>
            <div class="col-sm-3">
                <select name="jurusan_kode" id="jurusan_kode" class="form-control">
                    @foreach ($jurusan as $item)
                    <option {{ isset($jurusanKode) ? ($jurusanKode == $item->kode ? 'selected' : '' ) : '' }} value="{{ $item->kode }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-3">
                <button type="submit"class="btn btn-primary">Registrasikan Kelas Semester Aktif</button>
            </div>
        </div>
    </form>
</div>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Daftar Kelas Teregistrasi Pada Semester Aktif</h3>
        <!-- /.modal -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="table" class="table table-condensed">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Tahun Semester</th>
                    <th>Semester</th>
                    <th>Nama Mata Pelajaran</th>
                    <th>SKM</th>
                    <th>NIGN</th>
                    <th>Nama Guru</th>
                    <th>Kelas</th>
                    <th>Pilihan</th>
                </tr>
            </thead>
            @foreach ($kelas as $key => $value )
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $value->nama_semester }}</td>
                <td>{{ $value->mapel_semester }}</td>
                <td>{{ $value->mapel }}</td>
                <td>{{ $value->mapel_skm }}</td>
                <td>{{ $value->nign }}</td>
                <td>
                    @if(isset($value->nama_guru)) 
                    <button class="btn btn-primary btn-flat btn-sm" onclick="return showModal(`{{ $value->mapel }}`, `{{ $value->mapel_semester }}`, `{{ $value->kelas_id }}`)" title="Ubah">
                        {{$value->nama_guru}} 
                    </button>
                    @else 
                    <a class="btn btn-warning btn-flat btn-sm" onclick="return showModal(`{{ $value->mapel }}`, `{{ $value->mapel_semester }}`, `{{ $value->kelas_id }}`)" title="Register"><i class="fa fa-plus"></i></a> 
                    @endif
                </td>
                <td> <span class="label bg-blue">{{ $value->kelas_nama }}</span></td>
                <td> <a href="{{ route('kelas.peserta', $value->kelas_id) }}" class="btn btn-sm bg-black"> <i class="fa fa-list"></i> Peserta</a></td>
                {{-- <td>{{ $value->paket_semester }}</td> --}}
                
            </tr>
            @endforeach
        </table>
    </div>
    <!-- /.box-body -->
    <div class="modal fade" id="modal-dosen">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Pilih Guru</h4>
                        <div class="box-header label label-info">
                            <h3 class="box-title">Matapelajaran - <span id="textMatapelajaran"></span> (Semester : <span id="textSemester"></span>)</h3>
                        </div> 
                    </div>
                    <form action="{{ route('kelas.add-guru-mapel') }}" method="POST" id="formTambahDosen">
                        <input type="hidden" name="id_kelas" id="idKelas">
                        <div class="modal-body">
                            <table id="table-guru" class="table">
                                <thead>
                                    <tr>
                                        <th>NIGN</th>
                                        <th>Nama Guru</th>
                                        <th>Pilih</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($guru))
                                    @foreach ($guru as $itemGuru)
                                    <tr>
                                        <td>{{ $itemGuru->nign }}</td>
                                        <td>{{ $itemGuru->nama }}</td>
                                        <td>
                                            <input type="radio" name="id_guru" value="{{ $itemGuru->id }}">
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </div>
    @endsection
    
    @section('script')
    {{-- Datatable --}}
    <script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>


    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $('#table').DataTable({
            "pageLength": 50
        });
        $('#table-guru').DataTable({
            "pageLength": 50
        })
        function showModal(matapelajaran, semester, idKelas){
            $('input[type="radio"]')[0].checked = false;
            $('#textMatapelajaran').text(`${matapelajaran}`);
            $('#textSemester').text(`${semester}`);
            $('#idKelas').val(`${idKelas}`);
            $("#modal-dosen").modal('show');
            return false;
        }

        $(document).on('submit', '#formTambahDosen',function(e){
            $.LoadingOverlay("show");
            e.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method : $(this).attr('method'),
                url : $(this).attr('action'),
                data : $(this).serialize(),
                dataType : 'json',
            })
            .done(function(data){
                $.LoadingOverlay("hide");
                location.reload();
            })
            .fail(function(data){
                $.LoadingOverlay("hide");
                let json = data.responseJSON;
                var data = json.data;
                if(typeof data.id_guru != undefined){
                    data.id_guru.forEach(element => {
                        toastr.error(element)
                    });
                }
            });
        })
    </script>
    @endsection