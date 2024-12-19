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
        font-weight: bold;
        font-size: 10px;
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
<body class="A4 landscape">
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
                LAPORAN REKAP PRESENSI PESERTA DIDIK <BR>
                PERIODE {{ strtoupper($namabulan[$bulan])}} {{$tahun}}<BR>
                SMK PGRI 1 Mejayan
            </span><br>
            <span><i>Jl. Kolonel Marhadi No.25 Mejayan Kec. Mejayan Kab. Madiun</i></span>
        </td>
    </tr>
</table>
<table class="tabelpresensi">
    <tr>
        <th rowspan="2">No.</th>
        <th rowspan="2">NIS</th>
        <th rowspan="2">Nama Siswa</th>
        <th rowspan="2">Kelas</th>
        <th colspan="31">Tanggal</th>
        <th rowspan="2">TH</th>
        <th rowspan="2">TT</th>
    </tr>
    <tr>
        @for($i=1; $i<=31; $i++)
            <th style="text-align: center;">{{$i}}</th>
        @endfor
    </tr>
    @foreach($rekap as $d)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$d->nis}}</td>
        <td>{{$d->nama_lengkap}}</td>
        <td>{{$d->kelas}}</td>

        <?php
        $totalhadir=0;
        $totalterlambat=0;
            for($i=1; $i<=31; $i++){
            $tgl="tgl_".$i;
            if(empty($d->$tgl)){
                $hadir=['',''];
                $totalhadir+=0;
            }else{
                $hadir=explode("-",$d->$tgl);  
                $totalhadir += 1;
                if($hadir[0]>"07:00:00"){
                    $totalterlambat+=1;
                }         
            }   
        ?>
        <td style="text-align: center;">
            <span style="color:{{$hadir[0]>"07:00:00" ? "red" : ""}}">{{$hadir[0]}}</span><br>
            <span style="color:{{$hadir[0]<"15:30:00" ? "red" : ""}}">{{$hadir[0]}}</span>
        </td>
        <?php
            }
        ?>
        <td style="text-align: center;">{{$totalhadir}}</td>
        <td style="text-align: center;">{{$totalterlambat}}</td>
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