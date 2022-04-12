<html>
<head>
    <title>Cetak Nilai</title>
</head>
<body>
    <style type="text/css">
        table {
            width: 100%;
        }

        table,
        th,
        td {
            /* border: 1px solid black; */

        }

        th,
        td {
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
            text-align: center;
        }

        .noborder th,
        .noborder td {
            border: 0;
        }

    </style>
    <center>
        <font size="15">HASIL BELAJAR SISWA<br>
            SMK NEGERI 7 AMBON<br>
            TAHUN AKADEMIK {{ $semester->tahun_pelajaran }} {{ $semester->jenis_semester % 2 == 0 ? 'GENAP' : 'GANJIL' }}</font>
        <br>
        <hr>
        <br>
    </center>

    @if(isset($siswa))
    <table class="noborder">
        <tbody>
            <tr>
                <td><b>NIS</b></td>
                <td><span class="badge bg-white">: <b> {{ $siswa->nis }} </span></b></td>
            </tr>
            <tr>
                <td><b>NAMA</b></td>
                <td><span class="badge bg-light-white">: <b> {{ $siswa->nama }} </b></span></td>
            </tr>
        </tbody>
    </table>
    @endif
    <br>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th width="65%">Matapelajaran</th>
                <th>N. Raport Pengetahuan</th>
                <th>Predikat Pengetahuan</th>
                <th>N. Raport Ketrampilan</th>
                <th>Predikat Ketrampilan</th>
            </tr>
        </thead>
        <tbody>
            @if (! empty($nilai))
            <?php $i=1;foreach ($nilai as $value):  ?>
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $value->nama }}</td>
                <td>{{ $value->n_raport_pengetahuan ?? '-' }}</td>
                <td>{{ $value->predikat_pengetahuan ?? '-' }}</td>
                <td>{{ $value->n_raport_ketrampilan ?? '-' }}</td>
                <td>{{ $value->predikat_ketrampilan ?? '-' }}</td>
            </tr>
            <?php $i++; endforeach  ?>
            @endif
        </tbody>
    </table>
    <br>
    <table class="noborder">
        <tr>
            <td width="70%" align="center"></td>
            <td align="left">Ambon, {{ $today }}</td>
        </tr>
        <tr height="60px">
            <td width="70%" align="center"></td>
            <td></td>
        </tr>
        <tr>
            <td width="70%" align="center"></td>
            <td align="left"><br><br><br>_________________________</td>
        </tr>
    </table>
</body>
</html>
