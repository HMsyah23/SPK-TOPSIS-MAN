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
        <img src="{{asset('images/logo.png')}}" alt="" style="width:50%;">
        <h1 class="cover-heading">Selamat Datang</h1>
        <p class="lead">Di Website Penentuan Penerimaan Bantuan COVID-19 <br> Kelurahan Gunung Tabur BERAU</p>
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show alert" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">??</span>
              </button>
              {!! Session::get('error') !!}
            </div>
          @endif
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