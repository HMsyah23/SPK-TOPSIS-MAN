<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Detail Calon Penerima {{$calonPenerima->nama_kepala_keluarga}}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

</head>
<body>
  <style>
    #header,
    #footer {
      position: fixed;
      left: 0;
        right: 0;
        color: #aaa;
        font-size: 0.9em;
    }
    #header {
      top: 0;
        border-bottom: 0.1pt solid #aaa;
    }
    #footer {
      bottom: 0;
      border-top: 0.1pt solid #aaa;
    }
    .page-number:before {
        text-align: center;
        float: right;
        color: black;
      content: "Kelurahan Gunung Tabur | Hal " counter(page);
    }

    .page-break {
        page-break-after: always;
    }

    h1 {
        font-size: 40px;
    }

    h2 {
        font-size: 30px;
    }

    p {
        font-size: 12px;
        line-height:80%;
    }

    td{
      font-size: 10px;
      text-align: center;
      vertical-align: middle;
    }

    th{
      text-align: center;
    }
    .table > tbody > tr > td {
     vertical-align: middle;
    }
    </style>
<div>
  <div id="footer">
    <div class="page-number"></div>
  </div>
  <img src="{{$base64}}" width="100%" height="140"/>
  <table class="table table-sm table-borderless" style="border: white;">
    <thead class="mb-0">
      <tr>
        <th style="text-align: center; vertical-align: middle; font-size: 25px;" class="text-underline"><u>Laporan Detail Informasi Calon Penerima Bantuan</u></th>
    </tr>
    </thead>
  </table>
    <table class="table table-sm table-bordered">
        <thead style="font-size:10px;" class="thead-light">
          <tr>
            <th colspan="3" style="text-align: center; vertical-align: middle; font-size: 15px;"><span>Bidoata Calon Penerima Bantuan</span></th>
          </tr>
          <tr>
            <th style="text-align: center; vertical-align: middle;">No. KK</th>
            <td style="text-align: center; vertical-align: middle;">{{$calonPenerima->nik}}</td>
            <td rowspan="10">
              <img src="{{ url('public/'.json_decode($calonPenerima->berkas)->ktp) }}" class="mt-5 mb-0 px-0 py-0" alt="..." style="width: 100px; height: 120px;">
        </td>
          </tr>
          <tr>
            <th style="text-align: center; vertical-align: middle;">No. KTP</th>
            <td style="text-align: center; vertical-align: middle;">{{$calonPenerima->no_ktp}}</td>
          </tr>
          <tr>
            <th style="text-align: center; vertical-align: middle;">Nama</th>
            <td style="text-align: center; vertical-align: middle;">{{$calonPenerima->nama_kepala_keluarga}}</td>
          </tr>
          <tr>
            <th style="text-align: center; vertical-align: middle;">Jenis Kelamin</th>
            @if ($calonPenerima->jenis_kelamin == 1)
              <td style="text-align: center; vertical-align: middle;">Pria</td>
            @else
              <td style="text-align: center; vertical-align: middle;">Wanita</td>
            @endif
          </tr>
          <tr>
            <th style="text-align: center; vertical-align: middle;">No HP</th>
            <td style="text-align: center; vertical-align: middle;">{{$calonPenerima->no_hp}}</td>
          </tr>
          <tr>
            <th style="text-align: center; vertical-align: middle;">Tanggal Lahir</th>
            <td style="text-align: center; vertical-align: middle;">{{\Carbon\Carbon::parse($calonPenerima->tanggal_lahir)->isoFormat('dddd, D MMMM Y')}}</td>
          </tr>
          <tr>
            <th style="text-align: center; vertical-align: middle;">Umur</th>
            <td style="text-align: center; vertical-align: middle;">{{\Carbon\Carbon::parse($calonPenerima->tanggal_lahir)->age}} Tahun</td>
          </tr>
          <tr>
            <th style="text-align: center; vertical-align: middle;">Pendapatan Per Bulan</th>
            <td style="text-align: center; vertical-align: middle;"> @currency($calonPenerima->pendapatan_kepala_keluarga)</td>
          </tr>
          <tr>
            <th style="text-align: center; vertical-align: middle;">Jumlah Tanggungan</th>
            <td style="text-align: center; vertical-align: middle;">{{$calonPenerima->jumlah_tanggungan}} Orang</td>
          </tr>
          <tr>
            <th style="text-align: center; vertical-align: middle;">Pekerjaan</th>
            <td style="text-align: center; vertical-align: middle;">{{$calonPenerima->pekerjaan}}</td>
          </tr>
          <tr>
            <th style="text-align: center; vertical-align: middle;">Alamat</th>
            <td colspan="2" style="text-align: center; vertical-align: middle;">{{$calonPenerima->alamat}}</td>
          </tr>
        </thead>
    </table>


        <table class="table table-borderless">
          <tbody>
            <tr>
              <td></td>
              <td></td>
              <td style="width: 150px;">Penanggung Jawab,</td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td style="height: 20px; width: 150px;"></td>
            </tr>
            <tr>
              <td></td>
              <td ></td>
              <td style="width: 150px;"><u>..........................</u></td>
            </tr>
          </tbody>
        </table>

</div>
<script src="{{url('js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>