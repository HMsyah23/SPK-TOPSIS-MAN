@extends('adminlte::page')

@section('title', 'Admin | Ganti Password')

@section('content_header')
    <h1>Admin | Ganti Password</h1>
@stop

@section('content')
<div class="row">
  <div class="col-lg-3 col-12">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
      <div class="card-body box-profile">
        <h3 class="profile-username text-center">{{$user->name}}</h3>
        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item">
            <b>Email</b> <div class="float-right">{{$user->email}}</div>
          </li>
          <li class="list-group-item">
            <b>Peran</b> <div class="float-right">@if ($user->role == 1)
              Admin
          @else
              Staff
          @endif</div>
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
        <h3 class="card-title"><i class="fas fa-key"></i> Ganti Password</h3>
        <div class="card-tools">
          <a href="{{route('users.index')}}" class="btn btn-light text-dark btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
          </a>
        </div>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('admin.ganti',$user->id) }}"  method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{!! implode('', $errors->all('<div>:message</div>')) !!}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        @endif
              @if(session('error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                {!! Session::get('error') !!}
              </div>
            @endif
            @if(session('sukses'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                {!! Session::get('sukses') !!}
              </div>
            @endif
            </div>
            <div class="col">
              <div class="form-group">
                <label>Password Lama</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan Password Lama" value="{{old('password')}}" required>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label>Password Baru</label>
                <input type="password" name="baru" class="form-control" placeholder="Masukkan Password Baru" value="{{old('baru')}}" required>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer d-flex justify-content-end">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
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