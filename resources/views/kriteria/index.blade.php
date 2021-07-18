@extends('adminlte::page')

@section('title', 'Daftar Kriteria')

@section('content_header')
    <h1>Halaman Daftar Kriteria</h1>
@stop

@section('content')
<div class="row">
  <div class="col-md-12">
      <div class="card ">
          <div class="card-header ">
              <h4 class="card-title">Daftar Kriteria</h4>
          </div>
          <div class="card-body ">
              <div class="row">
                  <div class="col-md-12">
                    @foreach ($kriterias as $k)
                    <p> 
                        <button class="btn btn-primary btn-block text-left" type="button" data-toggle="collapse" data-target="#kriteria{{$k->id}}" aria-expanded="false" aria-controls="kriteria{{$k->id}}">
                            {{$k->kode}}. {{$k->nama}} ({{$k->bobot * 100}}%) ({{$k->tipe}})
                        </button>
                    </p>
                    <div class="collapse" id="kriteria{{$k->id}}">
                        <div class="card card-body">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{$k->kode}}. {{$k->nama}}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-primary">
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{$k->nama}}</th>
                                                    {{-- <th>Keterangan</th> --}}
                                                    <th>Nilai</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($k->subkriterias as $sk)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$sk->kondisi}}</td>
                                                        {{-- <td>Sangat Baik</td> --}}
                                                        <td>{{$sk->nilai}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                  </div>
              </div>                    
          </div>
      </div>
  </div>
</div>
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
{{-- <script>
  $(function () {
    $("#example1").DataTable({
      "columnDefs": [
        { "width": "10%", "targets": 1 }
      ],
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script> --}}
@stop