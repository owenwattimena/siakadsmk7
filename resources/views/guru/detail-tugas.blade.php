@extends('admin.templates.template')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('title')
<h1>
    Detail Tugas Kelas
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
            Detail Tugas
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table id="table" class="table">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>NIS</th>
                            <th>Siswa</th>
                            <th>Keterangan</th>
                            <th>File</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tugas as $key => $item)
                        @php
                        $file = explode('/', $item->file);
                        $file = 'storage/detail-tugas/'.end($file);
                        @endphp
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $item->nis }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td><a href="{{ asset($file) }}" target="_blank">Link File</a></td>
                            <td>{{ $item->created_at }}</td>
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
