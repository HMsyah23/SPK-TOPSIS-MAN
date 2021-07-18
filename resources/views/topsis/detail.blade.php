@extends('adminlte::page')

@section('title', 'TOPSIS | Detail Perhitungan')

@section('content_header')
    <h1>TOPSIS | Detail Perhitungan</h1>
@stop

@section('content')
<div class="row">
  <div class="col-md-12">
      <div class="card ">
          <div class="card-header ">
              <h4 class="card-title">Langkah Perhitungan TOPSIS</h4>
          </div>
          <div class="card-body ">
              <div class="row">
                  <div class="col-md-4">
                      <ul class="nav nav-pills nav-pills-primary flex-column" role="tablist">
                          <li class="nav-item">
                              <a class="nav-link active" data-toggle="tab" href="#link4" role="tablist">
                                  1. Nilai Kriteria
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#link5" role="tablist">
                                  2. Membuat Matriks Keputusan
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#link6" role="tablist">
                                  3. Normalisasi Matriks
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#link7" role="tablist">
                                  4. Normalisasi Matriks * Bobot
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#link8" role="tablist">
                                  5. Menentukan Solusi Ideal Positif & Negatif
                              </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#link9" role="tablist">
                                6. Menghitung Nilai Preferensi & Melakukan Perankingan
                            </a>
                        </li>
                      </ul>
                  </div>
                  <div class="col-md-8">
                      <div class="tab-content">
                          <div class="tab-pane active" id="link4">
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
                          <div class="tab-pane" id="link5">
                              <h5 class="text-primary">Membuat Matriks Keputusan :</h5>
                              <hr class="text-primary">
                              <div class="table-responsive">
                                  <table class="table">
                                      <thead class="text-white bg-primary">
                                          <tr>
                                              <th>#</th>
                                              <th>Alternatif</th>
                                              <th>C1</th>
                                              <th>C2</th>
                                              <th>C3</th>
                                              <th>C4</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @forelse ($data as $p)
                                          <tr>
                                              <td>A{{$loop->iteration}}</td>
                                              <td>({{$p['no_ktp']}}) {{$p['nama']}}</td>
                                              <td>{{$p['O_C1']}}</td>
                                              <td>{{$p['O_C2']}}</td>
                                              <td>{{$p['O_C3']}}</td>
                                              <td>{{$p['O_C4']}}</td>
                                          </tr>
                                          @empty
                                              <tr>
                                                  <td colspan="8" class="text-center">Belum Ada Data</td>
                                              </tr>
                                          @endforelse
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                          <div class="tab-pane" id="link6">
                            {{-- <h5 class="text-primary">Rumus menghitung normalisasi matriks :</h5> --}}
                            {{-- <img class="rounded mx-auto d-block" src="../assets/img/normalisasi.png" alt="" style="width: 50%;"> --}}
                              <h5 class="text-primary">Tabel Hasil Normalisasi :</h5>
                              <hr class="text-primary">
                              <div class="table-responsive">
                                <table class="table table-sm-responsive">
                                  <thead class="text-white bg-primary">
                                      <tr>
                                          <th>#</th>
                                          <th>Alternatif</th>
                                          <th>C1</th>
                                          <th>C2</th>
                                          <th>C3</th>
                                          <th>C4</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @forelse ($data as $p)
                                      <tr>
                                          <td>A{{$loop->iteration}}</td>
                                          <td>({{$p['no_ktp']}}) {{$p['nama']}}</td>
                                          <td>{{$p['N_C1']}}</td>
                                          <td>{{$p['N_C2']}}</td>
                                          <td>{{$p['N_C3']}}</td>
                                          <td>{{$p['N_C4']}}</td>
                                      </tr>
                                      @empty
                                          <tr>
                                              <td colspan="8" class="text-center">Belum Ada Data</td>
                                          </tr>
                                      @endforelse
                                  </tbody>
                              </table>
                              </div>
                          </div>
                          <div class="tab-pane" id="link7">
                              {{-- <h5 class="text-primary">Rumus menghitung Nilai Optimasi :</h5>
                              <img class="rounded mx-auto d-block" src="../assets/img/optimasi1.png" alt="" style="width: 50%;">
                              <img class="rounded mx-auto d-block" src="../assets/img/optimasi2.png" alt="" style="width: 50%;">
                              <hr class="text-primary"> --}}
                              <h5 class="text-primary">Tabel Normalisasi * Bobot :</h5>
                              <div class="table-responsive">
                                <table class="table table-sm-responsive">
                                  <thead class="text-white bg-primary">
                                      <tr>
                                          <th>#</th>
                                          <th>Alternatif</th>
                                          <th>C1</th>
                                          <th>C2</th>
                                          <th>C3</th>
                                          <th>C4</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @forelse ($data as $p)
                                      <tr>
                                          <td>A{{$loop->iteration}}</td>
                                          <td>({{$p['no_ktp']}}) {{$p['nama']}}</td>
                                          <td>{{$p['C1']}}</td>
                                          <td>{{$p['C2']}}</td>
                                          <td>{{$p['C3']}}</td>
                                          <td>{{$p['C4']}}</td>
                                      </tr>
                                      @empty
                                          <tr>
                                              <td colspan="8" class="text-center">Belum Ada Data</td>
                                          </tr>
                                      @endforelse
                                  </tbody>
                              </table>
                              </div>
                          </div>
                          <div class="tab-pane" id="link8">
                              <div class="table-responsive">
                                <h5 class="text-justify text-primary">Mencari nilai max dan min dari normalisasi berbobot, menggunakan metode perhitungan TOPSIS (Technique For Others Reference By Smilarity To Ideal Solution). </h5>
                                  <br> <small>Jika kriteria bersifat benefit (makin besar makin baik) maka V+ =Max dan V- = Min</small>
                                  <br><small>Jika kriteria bersifat Cost (makin kecil makin baik) maka V+ =Min dan V- = Max</small>
                                <table class="table table-md-responsive">
                                    <tr class="text-center bg-light">
                                        <th rowspan="2"><strong>Alternatif</strong></th>
                                        <th colspan="6"><strong>Kriteria</strong></th>
                                    </tr>
                                    <tr class="bg-light">
                                        <th>C1</th>
                                        <th>C2</th>
                                        <th>C3</th>
                                        <th>C4</th>
                                    </tr>
                                    <tr>
                                        <td class="bg-light"><strong>MAX</strong></td>
                                        <td>{{$bobot['perbaikan']['C1']['max']}}</td>
                                        <td>{{$bobot['perbaikan']['C2']['max']}}</td>
                                        <td>{{$bobot['perbaikan']['C3']['max']}}</td>
                                        <td>{{$bobot['perbaikan']['C4']['max']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light"><strong>MIN</strong></td>
                                        <td>{{$bobot['perbaikan']['C1']['min']}}</td>
                                        <td>{{$bobot['perbaikan']['C2']['min']}}</td>
                                        <td>{{$bobot['perbaikan']['C3']['min']}}</td>
                                        <td>{{$bobot['perbaikan']['C4']['min']}}</td>
                                    </tr>
                                </table>
                                <h5 class="text-justify text-primary">
                                  Langkah ke-lima, Menentukan jarak tiap alternatif menggunakan metode TOPSIS (Technique For Others Reference By Smilarity To Ideal Solution). Mencari Nilai A_X+ :                            
                                </h5>
                                <hr class="text-primary">
      
                              <table class="table table-sm-responsive">
                                  <tr class="bg-light">
                                      <th><strong>Alternatif</strong></th>
                                      <th><strong>Perhitungan Nilai A<sup>+</sup> </strong></th>
                                      <th><strong>A<sup>+</sup> </strong></th>
                                  </tr>
                                  @foreach ($data as $item)
                                  <tr>
                                          <td class="bg-light">A{{$loop->iteration}}+</td>    
                                          <td>√({{$bobot['perbaikan']['C1']['max']}} - {{$item->C1}})<sup>2</sup> + ({{$bobot['perbaikan']['C2']['max']}} - {{$item->C2}})<sup>2</sup> + ({{$bobot['perbaikan']['C3']['max']}} - {{$item->C3}})<sup>2</sup> + ({{$bobot['perbaikan']['C4']['max']}} - {{$item->C4}})<sup>2</sup>)<sup>2</sup> + </td>    
                                          <td>{{$item->A_max}}</td>    
                                      </tr>
                                  @endforeach
                                  <tr class="bg-light">
                                      <th><strong>Alternatif</strong></th>
                                      <th><strong>Perhitungan Nilai A<sup>-</sup> </strong></th>
                                      <th><strong>A<sup>-</sup> </strong></th>
                                  </tr>
                                  @foreach ($data as $item)
                                  <tr>
                                          <td class="bg-light">A{{$loop->iteration}}+</td>    
                                          <td>√({{$item->C1}} - {{$bobot['perbaikan']['C1']['min']}})<sup>2</sup> + ({{$item->C2}} - {{$bobot['perbaikan']['C2']['min']}})<sup>2</sup> + ({{$item->C3}} - {{$bobot['perbaikan']['C3']['min']}})<sup>2</sup> + ({{$item->C4}} - {{$bobot['perbaikan']['C4']['min']}})<sup>2</sup>)<sup>2</sup> + </td>    
                                          <td>{{$item->A_min}}</td>    
                                      </tr>
                                  @endforeach
                              </table>
                              <h5 class="text-justify">Sehingga di dapat :</h5>
                              <table class="table table-sm-responsive">
                                  <tr class="bg-light">
                                      <th colspan="4">
                                          <strong>Tabel nilai A<sup>+</sup> dan A<sup>-</sup> dari setiap Alternatif</strong>
                                      </th>
                                  </tr>
                                  <tr>
                                      <th colspan="2">
                                          <strong>A<sup>+</sup></strong>
                                      </th>
                                      <th colspan="2">
                                          <strong>A<sup>-</sup></strong>
                                      </th>
                                  </tr>
                                  @foreach ($data as $item)
                                  <tr>
                                      <td class="bg-light">A{{$loop->iteration}}<sup>+</sup></td>
                                      <td>{{$item->A_max}}</td>
                                      <td class="bg-light">A{{$loop->iteration}}<sup>-</sup></td>
                                      <td>{{$item->A_min}}</td>
                                  </tr>
                                  @endforeach
                              </table>
                              </div>
                          </div>
                          <div class="tab-pane" id="link9">
                            <h5 class="text-justify text-primary">Langkah ke-enam, menghitung nilai preferensi setiap alternatif terdekat dengan solusi ideal, menggunakan metode TOPSIS (Technique For Others Reference By Smilarity To Ideal Solution).
                            </h5>
                            <hr class="text-primary">
    
                            <table class="table table-sm-responsive">
                                <tr class="bg-light">
                                    <th><strong>Alternatif</strong></th>
                                    <th><strong>A<sup>-</sup> / (A<sup>-</sup> + A<sup>+</sup>)</strong></th>
                                    <th><strong>Nilai Preferensi</strong></th>
                                </tr>
                                @foreach ($data as $item)
                                <tr>
                                    <td class="bg-light">A{{$loop->iteration}}</td>
                                    <td>{{$item->A_min}} / ({{$item->A_min}} + {{$item->A_max}})</td>
                                    <td>{{$item->preferensi}}</td>
                                </tr>
                                @endforeach
                            </table>
    
                            <table class="table table-sm-responsive">
                                <tr class="bg-light">
                                    <th colspan="4"><strong>Hasil Nilai Akhir Data Calon Penerima Bantuan</strong></th>
                                </tr>
                                <tr>
                                    <th><strong>Ranking</strong></th>
                                    <th ><strong>Alternatif</strong></th>
                                    <th><strong>Nilai</strong></th>
                                </tr>
                                @foreach ($rank as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td class="bg-light">({{$item->no_ktp}}) {{$item->nama}}</td>
                                    <td>{{$item->preferensi}}</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                      </div>
                  </div>
              </div>                    
          </div>
      </div>
  </div>
</div>
@endsection

@section('css')
<style>
    * { font: 17px Calibri; } 
    table { width: 70%; }
    table, th, td { border: solid 1px #DDD;
        border-collapse: collapse; padding: 2px 3px; text-align: center;
    }
</style>
@endsection
