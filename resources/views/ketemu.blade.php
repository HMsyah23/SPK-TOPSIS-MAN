<!DOCTYPE html>
<!-- saved from url=(0049)https://getbootstrap.com/docs/4.0/examples/cover/ -->
<html lang="en"><link type="text/css" rel="stylesheet" id="dark-mode-custom-link"><link type="text/css" rel="stylesheet" id="dark-mode-general-link"><style lang="en" type="text/css" id="dark-mode-custom-style"></style><style lang="en" type="text/css" id="dark-mode-native-style"></style><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <title>Kelurahan Gunung Tabur BERAU</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/cover/">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('cover/bootstrap.min.css')}}" rel="stylesheet">
  
    <!-- Custom styles for this template -->
    <link href="{{asset('cover/cover.css')}}" rel="stylesheet">
  </head>

  <body class="text-center" cz-shortcut-listen="true">

    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
      <header class="masthead mb-auto">
        <div class="inner">
          {{-- <h3 class="masthead-brand">Kelurahan Gunung Tabur BERAU</h3> --}}
          {{-- <nav class="nav nav-masthead justify-content-center">
            <a class="nav-link active" href="https://getbootstrap.com/docs/4.0/examples/cover/#">Home</a>
            <a class="nav-link" href="https://getbootstrap.com/docs/4.0/examples/cover/#">Features</a>
            <a class="nav-link" href="https://getbootstrap.com/docs/4.0/examples/cover/#">Contact</a>
          </nav> --}}
        </div>
      </header>

      <main role="main" class="inner cover">
        <img src="{{asset('images/logo.png')}}" alt="" style="width:25%;">
        <h1 class="cover-heading">Selamat Datang</h1>
        <p class="lead">Penentuan Penerimaan Bantuan COVID-19 <br> Kelurahan Gunung Tabur BERAU</p>
        <div class=" rounded bg-light text-dark pt-3 pb-3 pl-2 pr-3">
          <h4 ><u>Informasi Bagi Penerima Bantuan</u></h4>
          <ol class="text-left">
            <li>Calon penerima adalah masyarakat yang masuk dalam pendataan RT/RW dan berada di kelurahangunung tabur.</li>
            <li>Keluarga miskin atau tidak mampu yang berdomisili kelurahan di bersangkutan</li>
            <li>Tidak termasuk dalam penerima Program Keluarga Harapan (PKH), Kartu Sembako, Kartu Pra Kerja, Bantuan Sosial Tunai (BST) dan bansos pemerintah lainnya</li>
            <li>Memiliki Nomor Induk Kependudukan (NIK).</li>
            <li>Jika penerima bantuan adalah petani maka Dana Kelurahan dapat digunakan untuk membeli pupuk.</li>
            <li>Jika penerima sudah terdaftar dan valid maka BLT akan diberikan melalui tunai dan non-tunai. Non-tunai diberikan melalui transfer ke rekening bank penerima dan tunai boleh menghubungi aparat kelurahan.</li>
          </ol>
        </div>
        <label class="h4">Ranking</label>
        <div class="d-flex justify-content-center">
          <table class="table table-hover table-bordered text-nowrap" id="datatable">
            <thead class="bg-success">
              <tr>
                <th>NIK</th>
                <th>No.KTP</th>
                <th>Nama </th>
                <th>Alamat</th>
                <th>Ranking</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($rank as $item)
              <tr>
                <td><b>{{$item['no_ktp']}}</b></td>
                <td><b>{{$item['nik']}}</b></td>
                <td><b>{{$item['nama']}}</b></td>
                <td><b>{{$item['alamat']}}</b></td>
                <td>{{$loop->iteration}}</td>
              </tr> 
              @endforeach
            </tbody>
          </table>
        </div>
            <small for="">Silahkan Masukkan NIK atau No KK untuk memeriksa apakah anda termasuk sebagai penerima bantuan</small>
        <form action="{{ route('cekStatus') }}"  method="POST" enctype="multipart/form-data">
            @csrf
        <div class="input-group mb-3">
            <input name="nomor" type="number" class="form-control" placeholder="Masukkan NIK atau No KK" aria-label="Masukkan NIK atau No KK" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-success" type="submit" id="button-addon2">Temukan <i class="fas fa-search"></i></button>
                </div>
            </div>
            
        </form>
      </main>

      <footer class="mastfoot mt-auto">
        <div class="inner">
          <p>Kelurahan Gunung Tabur BERAU<a href="https://kel-gn-tabur.elektron.my.id/"></a>, by <a href="#">@Maman</a>.</p>
        </div>
      </footer>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{asset('cover/jquery-3.2.1.slim.min.js.download')}}" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="{{asset('cover/popper.min.js.download')}}"></script>
    <script src="{{asset('cover/bootstrap.min.js.download')}}"></script>
  

</body>
</html>