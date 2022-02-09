<html>
<head>
    <title>Cetak Nilai {{ '' }}</title>
</head>
<body>
    <style type="text/css">
        table{
            width: 100%;
        }
        table, th, td {
            /* border: 1px solid black; */
            
        }
        th, td {
            padding: 5px;
            text-align: left;
            vertical-align: middle;
            border-bottom: 1px solid #ddd;
            font-size: 12px;
        }		
        th {
            border-top: 1px solid #ddd;
            height: 20px;
            background-color: #ddd;
            text-align : center;
        }
    </style>
    <center>
        <font size="14">HASIL BELAJAR SISWA<br>
            SMK NEGERI 7 AMBON<br>
            TAHUN AKADEMIK {{ '' }} / {{ '' }} {{ '' }}</font>
            <br>
            <hr>
            <br>
        </center>
        
        @if(!isset($kelaspeserta))
        
        <table >
            <tbody>
                <tr>
                    <td style="width: 150px">Mata Pelajaran</td>                                  
                    <td><span class="badge bg-light-white">: {{ $kelas->mapel }}</span></td>
                </tr>
                <tr>
                    <td>SKS</td>                                 
                    <td><span class="badge bg-yellow">: {{ $kelas->mapel_skm }}</span></td>                                  
                </tr>
                <tr>
                    <td>Kelas</td>                                 
                    <td><span class="badge bg-yellow">: {{ $kelas->kelas_nama }}</span></td>                                  
                </tr>
                <tr>
                    <td>Semester</td>                                 
                    <td><span class="badge bg-yellow">: {{ $kelas->mapel_semester }}</span></td>                                  
                </tr>                      
                
            </tbody>
        </table>
        @endif
        <br>
        <table >
            <thead>
                <tr>
                    <th>No.</th>          
                    <th>NIS</th>            
                    <th>NAMA</th>                                                    
                    <th>Nilai Pengetahuan</th>
                    <th>Nilai Ketrampilan</th>
                    <th>Nilai Akhir</th>
                    <th>Bobot Nilai</th>
                    <th>Predikat</th>
                </tr>
            </thead>
            <tbody>
                @if (! empty($kelasPeserta))
                <?php $i=1;foreach ($kelasPeserta as $itemPeserta):  ?>
                <tr>
                    <td align="center">{{$i}}</td>
                    <td align="center">{{$itemPeserta[1]}}</td>
                    <td>{{$itemPeserta[2]}}</td>
                    <td align="right">{{$itemPeserta[3]}}</td>
                    <td align="right">{{$itemPeserta[4]}}</td>
                    <td align="right">{{$itemPeserta[5]}}</td>
                    <td align="right">{{$itemPeserta[6]}}</td>
                    <td align="center">{{$itemPeserta[7]}}</td>
                </tr>
                <?php $i++; endforeach  ?>
                @endif 
            </tbody>                  
        </table>
        <br>
        <table border="0" >                    
            <tr>
                <td width="70%" align="center"></td>
                <td align="center">Ambon, {{ $today }}</td>	                            
            </tr>
            <tr height="60px">
                <td width="70%" align="center"></td>
                <td></td>	                            
            </tr>              
            <tr>
                <td width="70%" align="center"></td>
                <td align="center"><br><br><br>@if(!empty($kelas->nama_guru))<u>{{$kelas->nama_guru}}</u><br>{{ !empty($kelas->nign) ? 'NIGN. ' . $kelas->nign : '' }} @else _________________________ @endif</td>	                            
            </tr>            
        </table>
    </body>
    </html>