@extends('admin.templates.template')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
            <li class="active">Kelas Peserta</li>
           
          </ol>
@endsection
@section('content')
          
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Setting Semester Aktif</h3>
                  
                </div><!-- /.box-header -->
                <div class="box-header">
                  <h3 class="box-title">@if( ! empty($kelaspeserta[0]['mkkurKode'])) {{$kelaspeserta[0]['mkkurKode'].' - '.$kelaspeserta[0]['mkkurNama'].' - Kelas '.$kelaspeserta[0]['klsNama'] }} @endif</h3>
                </div>
                <div class="box-body flash-message">
                  @if (session('success')) 
                  <div class="alert alert-info">
                    <strong>{{ session('success') }}</strong>
                  </div>
                  @elseif (session('error')) 
                  <div class="alert alert-error">
                    <strong>{{ session('error') }}</strong>
                  </div>
                  @endif      
                </div>
                <div class="box-body">
                  <form action="{{ route('dashboard-guru.import-nilai', $kelasId) }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <table class="table">
                    <tbody>  
                      <tr >
                        <td colspan="2" >
                        1. Gunakan Tombol "Download Peserta Kelas" untuk mendownload format file Upload.<br>
                        2. Upload file dalam ekstensi *.xlsx, *.xls, *.csv dan format sesuai dengan format file yang didownload.
                        </td>
                        
                      </tr>                     
                      <tr>
                        <td width="250px"><input class="btn " type="file" name="import_file" required accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/></td>
                        <td align="left"><button class="btn btn-primary" type="submit">Import Nilai</button></td>     
                      </tr>                      
                    </tbody>
                    </table>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="klsId" value="{{ $kelasId }}">
                  </form>
                  
                </div>
                <div class="box-body">
                  <p><strong>Download form nilai untuk peserta kelas matakuliah.</strong></p>
                  <div class="btn-group">
                        <a href="{{ route('dashboard-guru.peserta-download', $kelasId) }}"><button type="button" class="btn btn-flat btn-success">Download Peserta Kelas</button></a>
                        {{-- <button aria-expanded="true" type="button" class="btn btn-flat btn-success dropdown-toggle" data-toggle="dropdown">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="">Tipe file <b>*.xlsx</b></a></li>
                          <li><a href="">Tipe file <b>*.xls</b></a></li>
                          <li class="divider"></li>
                          <li><a href="">Tipe file <b>*.csv</b></a></li>
                          
                        </ul> --}}
                  </div>
                </div>
                <div class="box-body col-md-12" align="right" >  
                  <a href="{{ route('dashboard-guru.nilai-kelas', [$kelasId, 'cetak'=>false]) }}" class="btn btn-flat btn-warning" value="Download Nilai Semester"><i class="fa fa-download"></i> Download</a>
                  <a href="{{ route('dashboard-guru.nilai-kelas', [$kelasId, 'cetak'=>true]) }}" class="btn btn-flat btn-info" value="Cetak Nilai Semester"><i class="fa fa-print"></i> Cetak</a>
                </div>

                <div class="box-body">
                  <table id="dataKurikulum" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>No.</th>          
                        <th>NIS</th>            
                        <th>Nama</th>                                                    
                        <th>Nilai Pengetahuan</th>
                        <th>Nilai Nilai Ketrampilan</th>
                        <th>Nilai Nilai Akhir</th>
                        <th>Nilai Bobot Nilai</th>
                        <th>Predikat</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                     @if (! empty($peserta))
                     <?php $i=1;foreach ($peserta as $itemPeserta):  ?>
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$itemPeserta->nis}}</td>
                        <td>{{$itemPeserta->nama}}</td>
                        <td>{{$itemPeserta->nilai_pengetahuan ?? '-'}}</td>
                        <td>{{$itemPeserta->nilai_ketrampilan ?? '-'}}</td>
                        <td>{{$itemPeserta->nilai_akhir ?? '-'}}</td>
                        <td>{{$itemPeserta->bobot_nilai ?? '-'}}</td>
                        <td>{{$itemPeserta->nilai_huruf ?? '-'}}</td>
                      </tr>
                      <?php $i++; endforeach  ?>
                    @endif  
                    </tbody>
                    
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->

@endsection
@section('script')

@endsection

