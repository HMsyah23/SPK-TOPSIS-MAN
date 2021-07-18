@extends('adminlte::page')

@section('title', 'Daftar Pengguna')

@section('content_header')
    <h1>Daftar Pengguna</h1>
@stop

@section('content')
<div class="row">
  <!-- Left col -->
  <section class="col-lg-12 connectedSortable">
    <div class="card direct-chat direct-chat-primary">
      <div class="card-header">
        <h3 class="card-title"> 
          Daftar Pengguna
          <span class="badge badge-primary"> {{$users->count()}}</span>
        </h3>

        <div class="card-tools">
          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-lg">
            <i class="fas fa-plus"></i> Tambah Data Pengguna
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="card-body mx-2 my-2 px-2 py-2">
        @if(session('error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                {!! Session::get('error') !!}
              </div>
            @endif
        @if(session('errors'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
              @foreach ($errors->all() as $error)
                  <div>{{ $error }}</div>
              @endforeach
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
        <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Peran</th>
                <th>Email</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($users as $item)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$item->name}}</td>
              @if ($item->role == 1)
                <td>Admin</td> 
              @else
                <td>Staff</td> 
              @endif
              <td>{{$item->email}}</td>
              <td>
                <div class="btn-group">
                  <a href="{{route('admin.password',$item->id)}}" class="btn btn-info">
                    <i class="fas fa-eye"></i>
                  </a>
                  @if ($item->id == Auth::user()->id)
                  @else
                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-lg-{{$item->id}}">
                    <i class="fas fa-trash"></i>
                  </button>
                  @endif
                </div>

                <div class="modal fade" id="modal-lg-{{$item->id}}">
                  <div class="modal-dialog modal-md">
                    <div class="modal-content">
                      <div class="modal-header bg-danger">
                        <h5 class="modal-title"><i class="fas fa-trash"></i> Hapus Data <strong>{{$item->name}}</strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                        <form action="{{ route('admin.user.destroy',$item->id) }}"  method="POST" enctype="multipart/form-data">
                          @csrf
                         
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-danger">Hapus Data</button>
                      </form>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
              </td>
            </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Peran</th>
                <th>Email</th>
                <th>Opsi</th>
              </tr>
            </tfoot>
          </table>
      </div>
    </div>

    <div class="modal fade" id="modal-lg">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><i class="fas fa-book"></i> Tambah Data Pengguna</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('users.store') }}"  method="POST" enctype="multipart/form-data">
              @csrf
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Nama Pengguna</label>
                      <input type="text" name="name" class="form-control" placeholder="Masukkan Nama Pengguna" value="{{old('name')}}" required>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" name="email" class="form-control" placeholder="Masukkan Email" value="{{old('email')}}" required>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Peran</label>
                      <select name="role" class="form-control">
                          <option value="1">Administrator</option>
                          <option value="2">Staff</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" name="password" class="form-control" placeholder="Masukkan Kata Sandi" value="{{old('password')}}" required>
                    </div>
                  </div>
                </div>
            
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </section>
  <!-- right col -->
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