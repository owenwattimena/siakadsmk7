@extends('admin.templates.template')
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('title')
<h1>
    Input Nilai Semester
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
    <form action="{{ route('nilai.input-nilai-jurusan') }}" method="post" class="form-horizontal">
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
                <button type="submit"class="btn btn-primary">Pilih</button>
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
        <table class="table table-condensed">
            <tr>
                <th style="width: 10px">#</th>
                <th>Tahun Semester</th>
                <th>Semester</th>
                <th>Nama Mata Pelajaran</th>
                <th>SKM</th>
                <th>No Guru</th>
                <th>Nama Guru</th>
                <th>Kelas</th>
                <th>Pilihan</th>
            </tr>
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
                        {{$value->nama_guru}} 
                    @else 
                    {{ '-' }}
                    @endif
                </td>
                <td> <span class="label bg-blue">{{ $value->kelas_nama }}</span></td>
                <td> <a href="{{ route('nilai.input-nilai-peserta', $value->kelas_id) }}" class="btn btn-sm bg-black"> <i class="fa fa-list"></i> Peserta</a></td>
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
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No Guru</th>
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
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
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