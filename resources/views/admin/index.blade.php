@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="row">
  <!-- Left col -->
  <section class="col-lg-12 connectedSortable">
    <div class="card direct-chat direct-chat-primary">
      <div class="card-body mx-2 my-2 px-2 py-2">
        <div class="col text-center">
          <img src="{{asset('images/Logo.png')}}" alt="" style="width:15%;">
          <h1>Selamat Datang <strong>{{Auth::user()->name}}</strong> </h1>
          <h3>Sistem Penunjang Keputusan</h3>
          <h5>Penentuan Penerimaan Bantuan COVID-19 Pada Kelurahan Gunung Tabur BERAU</h5>
          <span>Menggunakan Metode TOPSIS </span> <br>
      </div>
      <div class="row mt-3">
        @if (Auth::user()->role == 1)
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$users->count()}}</h3>
  
              <p>Daftar Pengguna</p>
            </div>
            <div class="icon">
              <i class="fas fa-user"></i>
            </div>
            <a href="{{route('users.index')}}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        @endif
        <!-- ./col -->
        <div class="col-lg-3 col-6 @if (Auth::user()->role == 2) offset-lg-1 @endif ">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{$kriterias->count()}}</h3>
  
              <p>Daftar Kriteria</p>
            </div>
            <div class="icon">
              <i class="fas fa-list"></i>
            </div>
            <a href="{{route('kriteria.index')}}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{$calons->count()}}</h3>
  
              <p>Daftar Calon Penerima Bantuan</p>
            </div>
            <div class="icon">
              <i class="fas fa-users"></i>
            </div>
            <a href="{{route('calon.index')}}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>TOPSIS</h3>
  
              <p>Perankingan TOPSIS</p>
            </div>
            <div class="icon">
              <i class="fas fa-calculator"></i>
            </div>
            <a href="{{route('ranking.index')}}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      </div>
    </div>
  </section>
  <!-- right col -->
</div>
    <!-- Small boxes (Stat box) -->
    
    <!-- /.row -->
    <!-- Main row -->
@stop

@section('css')
    <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('vendor/datatables/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('vendor/datatables-plugins/responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css')}}">
@stop

@section('js')
<script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendor/datatables-plugins/responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('vendor/datatables-plugins/responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendor/datatables-plugins/buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendor/datatables-plugins/buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendor/datatables-plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('vendor/datatables-plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('vendor/datatables-plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('vendor/datatables-plugins/buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('vendor/datatables-plugins/buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('vendor/datatables-plugins/buttons/js/buttons.colVis.min.js')}}"></script>
<!-- AdminLTE App -->
<script>
  $(function () {
    $("#example1").DataTable({
      "columnDefs": [
        { "width": "10%", "targets": 1 }
      ],
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
@stop