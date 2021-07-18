@extends('adminlte::page')

@section('title', 'TOPSIS | Perankingan')

@section('content_header')
    <h1>Ranking</h1>
@stop

@section('content')
  <div class="card bg-white pl-3 pr-3 pt-3 pb-3">
    <div class="card-body">
      <div class="row text-center">
          <h3> <i class="ion ion-stats-bars"></i> Hasil Perankingan Menggunakan Metode TOPSIS</h3>
          <div class="col d-flex justify-content-end">
            @if (Auth::user()->role == 1)
            <a href="{{route('laporan.ranking')}}" class="btn btn-primary btn-sm mr-1"> <i class="fa fa-print" style="font-size: 20px;"></i> <b style="font-size: 20px;">Laporan </b></a>
            @endif  
            <a class="btn btn-success btn-sm text-white"  href="{{route('ranking.detail')}}"> <i class="fas fa-calculator" style="font-size: 20px;"></i> <b style="font-size: 20px;">Detail Perhitungan TOPSIS </b></a>
          </div>
      </div>
      <div class="row mt-1 mb-0">
        <div class="col">
          @if (session('status'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('status') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          @endif
          @if(Session::has('errors'))
          @if (is_array($errors))
            @if (count($errors) > 0)
            <div class="alert alert-danger">
              <div class="card-header">
                <h3 class="card-title"><strong>Gagal Tersimpan</strong></h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            </div>
            @elseif (session('errorr'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{ session('errorr') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
            @endif
          @else
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('errors') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
          @endif
        @endif
        </div>
      </div>
      <div class="row mt-5">
        <div class="col-lg-12">
          <label class="h4">Detail</label>
          <div class="table-responsive mb-5">
            <table class="table table-hover table-bordered text-nowrap" id="datatable">
              <thead class="bg-primary">
                <tr>
                  <th rowspan="2" style="text-align: center; vertical-align: middle;"> Nomor <br> KTP</th>
                  <th colspan="5"> Kriteria </th>
                </tr>
                <tr>
                  <th>Pekerjaan</th>
                  <th>Usia</th>
                  <th>Jumlah Tanggungan</th>
                  <th>Pendapatan</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $item)
                <tr>
                  <td><b>{{$item['no_ktp']}} ({{$item['nama']}})</b></td>
                  <td>{{$item['pekerjaan']}}</td>
                  <td>{{$item['usia']}} Tahun</td>
                  <td>{{$item['tanggungan']}} Orang</td>
                  <td>@currency($item['pendapatan'])</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>  
        <label class="h4">Ranking</label>
          <div class="table-responsive mb-5">
            <table class="table table-hover table-bordered text-nowrap" id="datatable">
              <thead class="bg-primary">
                <tr>
                  @if (Auth::user()->role == 1)
                  <th></th>
                  @endif
                  <th>No.KTP</th>
                  <th>Nama </th>
                  <th>Alamat</th>
                  <th>Ranking</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($rank as $item)
                <tr>
                  @if (Auth::user()->role == 1)
                  <td><a href="{{route('laporan.pelamar',$item['id'])}}" class="btn btn-sm btn-primary"><i class="fa fa-print"></i></a></td>
                  @endif
                  <td><b>{{$item['no_ktp']}}</b></td>
                  <td><b>{{$item['nama']}}</b></td>
                  <td><b>{{$item['alamat']}}</b></td>
                  <td>{{$loop->iteration}}</td>
                </tr> 
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop