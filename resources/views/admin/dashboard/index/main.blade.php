@extends('admin.templates.template')
@section('title')
<h1>
    Dashboard
    <small>Control panel</small>
</h1>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
</ol>
@endsection
@section('content')
    <div class="callout callout-info">
        <h4>Selamat Datang Admin!</h4>
        <p>Untuk menggunakan SIAKAD TKJ harap diperhatikan bagian-bagian data inti yang perlu dipersiapkan sebelumnya sebelum siap digunakan. </p>
    </div>

    <div class="box">
        <div class="box-header with-border">
        <h3 class="box-title">Penting !!</h3>
        <div class="box-tools pull-right">
            <button data-original-title="Collapse" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title=""><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>
        </div>
        <div style="display: block;" class="box-body">

        Data penting yang perlu disiapkan antara lain :
            <ul>
            <li>
            1. Data Jurusan</li>              
            <li>
            2. Data Kurikulum</li>
            <li>
            3. Matapelajaran yang ada dalam kurikulum.</li>
            <li>
            4. Semester Aktif</li>
            <li>
            5. Semester Jurusan Aktif</li>
            <li>
            6. Data Master Guru</li>
            <li>
            7. Data Master Siswa</li>
            <li>
            8. Proses registrasi siswa pada semester aktif</li>
            <li>
            9. Proses registrasi matapelajaran pada semester aktif</li>
            <li>
            10. Pembentukan kelas untuk matapelajaran dan peserta matapelajaran</li>
            <li>
            11. Penentuan guru pengampu pada kelas matapelajaran</li>
            <li>
            12. Proses download peserta dan input nilai matapelajaran</li>
            <li>
            13. Penentuan hak akses untuk guru</li>
            <li>
            14. Penentuan hak akses untuk siswa</li>
            </ul>
        </div><!-- /.box-body -->
        <div style="display: block;" class="box-footer">
        nb : Dalam proses ini sangat tergantung pada urutan proses.
        </div><!-- /.box-footer-->
    </div>
    </section>
@endsection
