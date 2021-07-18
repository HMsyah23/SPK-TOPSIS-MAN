@extends('adminlte::page')

@section('title', 'Daftar Calon Penerima Bantuan')

@section('content_header')
    <h1>Daftar Calon Penerima Bantuan</h1>
@stop

@section('content')
    <!-- Small boxes (Stat box) -->

    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-12 connectedSortable">
        <div class="card direct-chat direct-chat-primary">
          <div class="card-header">
            <h3 class="card-title"> 
              Daftar Pelamar 
              <span class="badge badge-primary"> {{$calons->count()}}</span>
            </h3>

            <div class="card-tools">
              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-lg">
                <i class="fas fa-book"></i> Input Data Calon Penerima Bantuan
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
                    <th>Nama Kepala Keluarga</th>
                    <th>Pendapatan Per Bulan</th>
                    <th>Usia</th>
                    <th>Jumlah Tanggungan</th>
                    <th>Pekerjaan</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($calons as $item)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>Nama : {{$item->nama_kepala_keluarga}} <br>NIK  : {{$item->nik}} <br>No KTP  : {{$item->no_ktp}}</td>
                  <td>@currency($item->pendapatan_kepala_keluarga)</td>
                  <td>{{\Carbon\Carbon::parse($item->tanggal_lahir)->age.' Tahun'}}</td>
                  <td>{{$item->jumlah_tanggungan}} Orang</td>
                  <td>{{$item->pekerjaan}}</td>
                  <td>
                    <div class="btn-group">
                      <div class="btn-group">
                        <a href="{{route('calon.show',$item->id)}}" class="btn btn-info">
                          <i class="fas fa-eye"></i>
                        </a>
                        @if ($item->role == 1)
                        @else
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-lg-{{$item->id}}">
                          <i class="fas fa-trash"></i>
                        </button>
                        @endif
                      </div>
                    </div>

                    <div class="modal fade" id="modal-lg-{{$item->id}}">
                      <div class="modal-dialog modal-md">
                        <div class="modal-content">
                          <div class="modal-header bg-danger">
                            <h5 class="modal-title"><i class="fas fa-trash"></i> Hapus Data Calon Penerima Bantuan <br> <strong>{{$item->nama_kepala_keluarga}}</strong></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                            <form action="{{ route('calon.destroy',$item->id) }}"  method="POST" enctype="multipart/form-data">
                              @csrf
                             @method('DELETE')
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
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Pendidikan</th>
                    <th>Usia</th>
                    <th>Status</th>
                    <th>Opsi</th>
                  </tr>
                </tfoot>
              </table>
          </div>
        </div>
      </section>
      <!-- right col -->
    </div>
    <!-- /.row (main row) -->

    <div class="modal fade" id="modal-lg">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><i class="fas fa-book"></i> Input Data Calon Penerima Bantuan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('calon.store') }}"  method="POST" enctype="multipart/form-data">
              @csrf
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label>NIK</label>
                      <input type="number" name="nik" class="form-control" placeholder="Masukkan NIK" value="{{old('nik')}}"  minlength="16" required>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label>No KTP Kepala Keluarga</label>
                      <input type="number" name="no_ktp" class="form-control" placeholder="Masukkan No KTP Kepala Keluarga" value="{{old('no_ktp')}}"  minlength="16" required>
                    </div>
                  </div>
                  <div class="col-8">
                    <div class="form-group">
                      <label>Nama Kepala Keluarga</label>
                      <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Kepala Keluarga" value="{{old('nama')}}"  min="1" max="10" required>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label>Jenis Kelamin</label>
                      <select name="jenis_kelamin" class="form-control">
                        <option value="1">Pria</option>
                        <option value="2">Wanita</option>
                    </select>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label>Tanggal Lahir Kepala Keluarga</label>
                      <input type="date" name="tanggal_lahir" class="form-control" placeholder="Masukkan Tanggal Lahir Kepala Keluarga" value="{{\Carbon\Carbon::parse(old('tanggal_lahir'))->format('Y-m-d')}}"  required>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label>Agama</label>
                      <select name="agama" class="form-control">
                        <option>Islam</option>
                        <option>Protestan</option>
                        <option>Katolik</option>
                        <option>Hindu</option>
                        <option>Buddha</option>
                        <option>Khonghucu</option>
                    </select>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label>No Hp</label>
                      <input type="number" name="no_hp" class="form-control" placeholder="Masukkan Nomor HP" value="{{old('no_hp')}}" required>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Pendapatan Kepala Keluarga (Rp)</label>
                      <input type="number" name="pendapatan_kepala_keluarga" class="form-control" placeholder="Masukkan pendapatan Kepala Keluarga selama satu bulan" value="{{old('pendapatan_kepala_keluarga')}}" required>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Jumlah Tanggungan (Orang)</label>
                      <input type="number" name="jumlah_tanggungan" class="form-control" placeholder="Masukkan Jumlah Tanggungan" value="{{old('jumlah_tanggungan')}}" required>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Pekerjaan</label>
                      <select name="pekerjaan" class="form-control">
                          <option value="Petani">Petani</option>
                          <option value="Buruh">Buruh</option>
                          <option value="Pedagang">Pedagang</option>
                          <option value="Karyawan">Karyawan</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label>Alamat</label>
                      <textarea name="alamat" class="form-control" cols="2" rows="3" required></textarea>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Foto KTP</label>
                      <input type="file" name="ktp" class="form-control" value="{{old('ktp')}}" required>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Foto KK</label>
                      <input type="file" name="kk" class="form-control" value="{{old('kk')}}" required>
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
    <!-- /.modal -->

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