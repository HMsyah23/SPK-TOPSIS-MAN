@extends('adminlte::page')

@section('title', 'Calon Penerima Bantuan | Detail')

@section('content_header')
    <h1>Calon Penerima Bantuan | Detail</h1>
@stop

@section('content')
<div class="row">
  <div class="col">
    @if(session('error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                {!! Session::get('error') !!}
              </div>
            @endif
            @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                {!! Session::get('success') !!}
              </div>
            @endif
  </div>
</div>
<div class="row">
  <div class="col-lg-3 col-12">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
      <div class="card-body box-profile">
        <div class="text-center">
          {{-- <img class="profile-user-img img-fluid img-circle"
               src="{{asset('public/pelamar/foto/'.$calon->foto)}}"
               alt="User profile picture"> --}}
        </div>

        <h3 class="profile-username text-center">{{$calon->nama_kepala_keluarga}}</h3>

        <p class="text-muted text-center">No.KTP : {{$calon->no_ktp}}</p>
        @if ($calon->jenis_kelamin == 1)
          <p class="text-muted text-center">Pria</p>
        @else
          <p class="text-muted text-center">Wanita</p>   
        @endif
        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item">
            <b>No HP</b> <div class="float-right">{{$calon->no_hp}}</div>
          </li>
          <li class="list-group-item">
            <b>Tanggal Lahir</b> <div class="float-right">{{\Carbon\Carbon::parse($calon->tanggal_lahir)->isoFormat('dddd, D MMMM Y')}}</div>
          </li>
          <li class="list-group-item">
            <b>Usia</b> <div class="float-right">{{\Carbon\Carbon::parse($calon->tanggal_lahir)->age.' Tahun'}}</div>
          </li>
          <li class="list-group-item">
            <b>Pendapatan Per Bulan</b> <div class="float-right">@currency($calon->pendapatan_kepala_keluarga)</div>
          </li>
          <li class="list-group-item">
            <b>Pekerjaan</b> <div class="float-right">{{$calon->pekerjaan}}</div>
          </li>
          <li class="list-group-item">
            <b>Jumlah Tanggungan</b> <div class="float-right">{{$calon->jumlah_tanggungan}} Orang</div>
          </li>
          <li class="list-group-item">
            <b>Alamat</b> <div class="float-right">{{$calon->alamat}}</div>
          </li>
          <li class="list-group-item">
            <b>KTP</b> <div class="float-right"><a target="_blank" href="{{public_path('public/'.json_decode($calon->berkas)->ktp)}}" class="btn btn-sm btn-primary"><i class="fas fa-file-pdf"></i></a></div>
          </li>
          <li class="list-group-item">
            <b>Kartu Keluarga</b> <div class="float-right"><a target="_blank" href="{{public_path('public/'.json_decode($calon->berkas)->kk)}}" class="btn btn-sm btn-primary"><i class="fas fa-file-pdf"></i></a></div>
          </li>
        </ul>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- ./col -->
  <div class="col-lg-9 col-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Detail Calon Penerima Bantuan</h3>
        <div class="card-tools">
          <a href="{{route('calon.index')}}" class="btn btn-light text-dark btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
          </a>
        </div>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('calon.update',$calon->id) }}"  method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label>NIK</label>
                <input type="number" name="nik" class="form-control" placeholder="Masukkan NIK" value="{{$calon->nik}}"  minlength="16" required>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>No KTP Kepala Keluarga</label>
                <input type="number" name="no_ktp" class="form-control" placeholder="Masukkan No KTP Kepala Keluarga" value="{{$calon->no_ktp}}"  minlength="16" required>
              </div>
            </div>
            <div class="col-8">
              <div class="form-group">
                <label>Nama Kepala Keluarga</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Kepala Keluarga" value="{{$calon->nama_kepala_keluarga}}"  min="1" max="10" required>
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control">
                  <option @if($calon->jenis_kelamin == 1) selected @endif value="1">Pria</option>
                  <option @if($calon->jenis_kelamin == 2) selected @endif value="2">Wanita</option>
              </select>
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label>Tanggal Lahir Kepala Keluarga</label>
                <input type="date" name="tanggal_lahir" class="form-control" placeholder="Masukkan Tanggal Lahir Kepala Keluarga" value="{{\Carbon\Carbon::parse($calon->tanggal_lahir)->format('Y-m-d')}}"  required>
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label>Agama</label>
                <select name="agama" class="form-control">
                  <option @if($calon->agama == "Islam") selected @endif>Islam</option>
                  <option @if($calon->agama == "Protestan") selected @endif>Protestan</option>
                  <option @if($calon->agama == "Katolik") selected @endif>Katolik</option>
                  <option @if($calon->agama == "Hindu") selected @endif>Hindu</option>
                  <option @if($calon->agama == "Buddha") selected @endif>Buddha</option>
                  <option @if($calon->agama == "Khonghucu") selected @endif>Khonghucu</option>
              </select>
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label>No Hp</label>
                <input type="number" name="no_hp" class="form-control" placeholder="Masukkan Nomor HP" value="{{$calon->no_hp}}" required>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                <label>Pendapatan Kepala Keluarga (Rp)</label>
                <input type="number" name="pendapatan_kepala_keluarga" class="form-control" placeholder="Masukkan pendapatan Kepala Keluarga selama satu bulan" value="{{$calon->pendapatan_kepala_keluarga}}" required>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                <label>Jumlah Tanggungan (Orang)</label>
                <input type="number" name="jumlah_tanggungan" class="form-control" placeholder="Masukkan Jumlah Tanggungan" value="{{$calon->jumlah_tanggungan}}" required>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                <label>Pekerjaan</label>
                <select name="pekerjaan" class="form-control">
                    <option @if($calon->pekerjaan == "Petani") selected @endif value="Petani">Petani</option>
                    <option @if($calon->pekerjaan == "Buruh") selected @endif value="Buruh">Buruh</option>
                    <option @if($calon->pekerjaan == "Pedagang") selected @endif value="Pedagang">Pedagang</option>
                    <option @if($calon->pekerjaan == "Karyawan") selected @endif value="Karyawan">Karyawan</option>
                </select>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" cols="2" rows="3" required>{!!$calon->alamat!!}</textarea>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Foto KTP</label>
                <input type="file" name="ktp" class="form-control">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Foto KK</label>
                <input type="file" name="kk" class="form-control">
              </div>
            </div>
          </div>
        <!-- /.card-body -->
    </div>
    <div class="card-footer d-flex justify-content-end">
      <button type="submit" class="btn btn-primary">Perbarui</button>
    </div>
  </form>
  </div>
  <!-- ./col -->
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop