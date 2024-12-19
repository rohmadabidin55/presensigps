<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A4</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>@page { size: A4 }
    #title{
        font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 18px;
        font-weight: bold;
    }

    .tabeldatasiswa{
        margin-top: 40px;
    }

       .tabeldatasiswa td {
        padding: 4px;

    }
    .tabelpresensi{
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }
    .tabelpresensi tr th{
        border: 1px solid black;
        padding: 7px;
        background-color:rgb(182, 179, 179);
    }
        .tabelpresensi tr td{
        border: 1px solid black;
        padding: 5px;
        font-size: 12px;
        
    }
    .foto{
        width: 30px;
        height: 40px;
    }
  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">
<?php
function selisih($jam_masuk, $jam_keluar)
        {
            list($h, $m, $s) = explode(":", $jam_masuk);
            $dtAwal = mktime($h, $m, $s, "1", "1", "1");
            list($h, $m, $s) = explode(":", $jam_keluar);
            $dtAkhir = mktime($h, $m, $s, "1", "1", "1");
            $dtSelisih = $dtAkhir - $dtAwal;
            $totalmenit = $dtSelisih / 60;
            $jam = explode(".", $totalmenit / 60);
            $sisamenit = ($totalmenit / 60) - $jam[0];
            $sisamenit2 = $sisamenit * 60;
            $jml_jam = $jam[0];
            return $jml_jam . " Jam " . round($sisamenit2)." Menit";
        }
?>
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">
<table style="width: 100%;" >

    <tr>
        <td style="width:30px">
            <img src="{{asset('assets/img/logo smk.png')}}" width="70" height="70" alt="">
        </td>
        <td>
            <span id="title">
                LAPORAN PRESENSI PESERTA DIDIK <BR>
                PERIODE {{ strtoupper($namabulan[$bulan])}} {{$tahun}}<BR>
                SMK PGRI 1 Mejayan
            </span><br>
            <span><i>Jl. Kolonel Marhadi No.25 Mejayan Kec. Mejayan Kab. Madiun</i></span>
        </td>
    </tr>
</table>

<table class="tabeldatasiswa">
        <tr>
        <td rowspan="6">
            @php
            $path=Storage::url('uploads/siswa/'.$siswa->foto);
            @endphp
            <img src="{{url($path)}}" width="120px" height="150" alt="">
        </td>
    </tr>
    <tr>
        <td>NIS</td>
        <td>:</td>
        <td>{{$siswa->nis}}</td>
    </tr>
        <tr>
        <td>Nama</td>
        <td>:</td>
        <td>{{$siswa->nama_lengkap}}</td>
    </tr>
        </tr>
        <tr>
        <td>Kelas</td>
        <td>:</td>
        <td>{{$siswa->kelas}}</td>
    </tr>
        </tr>
        <tr>
        <td>Jurusan</td>
        <td>:</td>
        <td>{{$siswa->nama_jurusan}}</td>
    </tr>
        </tr>
        </tr>
        <tr>
        <td>No HP Orang Tua</td>
        <td>:</td>
        <td>{{$siswa->no_hp}}</td>
    </tr>

</table>

<table class="tabelpresensi">
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Jam Masuk</th>
        <th>Jam Pulang</th>
        <th>Keterlambatan</th>
        <th>Jumlah Jam Belajar</th>
    </tr>
    @foreach($presensi as $d)
            @php
            $pathin=Storage::url('uploads/absensi/'.$d->foto_in);
            $pathout=Storage::url('uploads/absensi/'.$d->foto_out);
            $jamterlambat=selisih('07:00:00',$d->jam_in);
            @endphp
            
            <tr>
                <td style="text-align: center;">{{$loop->iteration}}</td>
                <td style="text-align: center;">{{date('d-m-Y', strtotime($d->tgl_presensi))}}</td>
                <td style="text-align: center;">{{$d->jam_in}}</td>
                <td style="text-align: center;">{{$d->jam_out!=null?$d->jam_out:'Belum Absen'}}</td>
                <td style="text-align: center;">
                    @if($d->jam_in>'07:00')
                        Terlambat<br>{{$jamterlambat}}
                    @else
                        Tepat Waktu
                    @endif
                    
                </td>
                <td style="text-align: center;">
                    @if($d->jam_out!=null)
                        @php
                        $jmljamsekolah=selisih($d->jam_in,$d->jam_out);
                        @endphp
                        @else
                        @php
                        $jmljamsekolah=0;
                        @endphp
                    @endif
                    {{ $jmljamsekolah}}
                </td>
            </tr>
    @endforeach
</table>

<table width="100%" style="margin-top: 100px;" >
    <tr>
        <td></td>
        <td style="text-align: center;">Mejayan, {{date('d-m-Y')}}</td>
    </tr>
    <tr>
        <td style="text-align:center; vertical-align:bottom" height="100px">
            <u>Anis Nur Alifah, S.Ag.</u><br>
            <i><b>Waka Kesiswaan</b></i>
        </td>
                <td style="text-align:center; vertical-align:bottom ">
            <u>Drs. Sampun Hadam, MM.</u><br>
            <i><b>Kepala Sekolah</b></i>
        </td>
    </tr>
</table>

  </section>

</body>

</html>