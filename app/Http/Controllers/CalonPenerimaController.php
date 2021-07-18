<?php

namespace App\Http\Controllers;

use App\CalonPenerima,App\User,App\SubKriteria, App\NilaiCalon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use Validator;
use Hash;
use Session;
use Intervention\Image\Facades\Image;

class CalonPenerimaController extends Controller
{

    public function index()
    {
        $calons = CalonPenerima::all();
        return view('calon.index',compact('calons'));
    }

    public function create()
    {
        //
    }

    public function store(Request $r)
    {
        // dd($r->all());

        $r->validate([
            'nik'                        => 'required',
            'no_ktp'                     => 'required',
            'nama'                       => 'required',
            'tanggal_lahir'              => 'required',
            'jenis_kelamin'              => 'required',
            'no_hp'                      => 'required',
            'pendapatan_kepala_keluarga' => 'required',
            'jumlah_tanggungan'          => 'required',
            'agama'                      => 'required',
            'pekerjaan'                  => 'required',
            'alamat'                     => 'required',
            'ktp'                        => 'required|max:1024|mimes:pdf,jpg,png,jpeg',
            'kk'                         => 'required|max:1024|mimes:pdf,jpg,png,jpeg',
        ]);
        
        if ($r->ktp != null) {
            $r->ktp->store('calon_penerima/foto_ktp', 'public');
        }

        if ($r->kk != null) {
            $r->kk->store('calon_penerima/foto_kk', 'public');
        }

        $berkas = collect(['ktp' => 'calon_penerima/foto_ktp/'.$r->ktp->hashName(),'kk' => 'calon_penerima/foto_kk/'.$r->kk->hashName()]);

        $calon = CalonPenerima::create([
            'nik' => $r->nik, 
            'no_ktp' => $r->no_ktp, 
            'nama_kepala_keluarga' => $r->nama, 
            'tanggal_lahir' => $r->tanggal_lahir, 
            'jenis_kelamin' => $r->jenis_kelamin, 
            'no_hp' => $r->no_hp, 
            'pendapatan_kepala_keluarga' => $r->pendapatan_kepala_keluarga, 
            'jumlah_tanggungan' => $r->jumlah_tanggungan, 
            'agama' => $r->agama, 
            'pekerjaan' => $r->pekerjaan, 
            'alamat' => $r->alamat, 
            'berkas' => json_encode($berkas), 
        ]);

        $pendapatan = $r->pendapatan_kepala_keluarga;
        if($pendapatan < 300000){
            $c1 = "C11";
        }elseif(($pendapatan >= 300000) && ($pendapatan <= 599999)){
            $c1 = "C12";
        }elseif(($pendapatan >= 600000) && ($pendapatan <= 999999)){
            $c1 = "C13";
        }elseif(($pendapatan > 999999)){
            $c1 = "C14";
        }
        $c1 = Subkriteria::where('kode',$c1)->first('id')->id;

        $tanggungan = $r->jumlah_tanggungan;
        if($tanggungan > 6){
            $c2 = "C21";
        }elseif(($tanggungan >= 5) && ($tanggungan <= 6)){
            $c2 = "C22";
        }elseif(($tanggungan >= 3) && ($tanggungan <= 4)){
            $c2 = "C23";
        }elseif(($tanggungan < 3)){
            $c2 = "C24";
        }
        $c2 = Subkriteria::where('kode',$c2)->first('id')->id;
        
        $pekerjaan = $r->pekerjaan;
        if($pekerjaan == "Petani"){
            $c3 = "C31";
        }elseif($pekerjaan == "Buruh"){
            $c3 = "C32";
        }elseif($pekerjaan == "Pedagang"){
            $c3 = "C33";
        }elseif($pekerjaan == "Karyawan"){
            $c3 = "C34";
        }
        $c3 = Subkriteria::where('kode',$c3)->first('id')->id;
        
        $umur = Carbon::parse($r->tanggal_lahir)->age;
        if($umur > 59){
            $c4 = "C41";
        }elseif(($umur >= 50) && ($umur <= 59)){
            $c4 = "C42";
        }elseif(($umur >= 40) && ($umur <= 49)){
            $c4 = "C43";
        }elseif($umur < 40){
            $c4 = "C44";
        }
        $c4 = Subkriteria::where('kode',$c4)->first('id')->id;
        
        NilaiCalon::create([ 
            'id_calon_penerima' => $calon->id, 
            'c1' => $c1, 
            'c2' => $c2, 
            'c3' => $c3, 
            'c4' => $c4, 
        ]);

        Session::flash('success', 'Data Calon Penerima Bantuan Berhasil Ditambahkan');
        return redirect()->back();
    }

    public function show($id)
    {
        $calon = CalonPenerima::find($id);
        return view('calon.show',compact('calon'));
    }

    public function edit(Pelamar $pelamar)
    {
        //
    }

    public function update(Request $r,$id)
    {
        $calon = CalonPenerima::find($id);
            $calon->nik = $r->nik;
            $calon->no_ktp = $r->no_ktp;
            $calon->nama_kepala_keluarga = $r->nama;
            $calon->tanggal_lahir = $r->tanggal_lahir;
            $calon->jenis_kelamin = $r->jenis_kelamin;
            $calon->no_hp = $r->no_hp;
            $calon->pendapatan_kepala_keluarga = $r->pendapatan_kepala_keluarga;
            $calon->jumlah_tanggungan = $r->jumlah_tanggungan;
            $calon->agama = $r->agama;
            $calon->pekerjaan = $r->pekerjaan;
            $calon->alamat = $r->alamat;
            $ktp = json_decode($calon->berkas)->ktp;
            $kk  = json_decode($calon->berkas)->kk;

        if ($r->ktp != null) {
            $r->ktp->store('calon_penerima/foto_ktp', 'public');
            $ktp = 'calon_penerima/foto_ktp/'.$r->ktp->hashName();
        }

        if ($r->kk != null) {
            $r->kk->store('calon_penerima/foto_kk', 'public');
            $kk = 'calon_penerima/foto_kk/'.$r->kk->hashName();
        }
        $berkas = collect(['ktp' => $ktp,'kk' => $kk]);
        $calon->berkas = json_encode($berkas);
        $calon->save();

        $pendapatan = $calon->pendapatan_kepala_keluarga;
        if($pendapatan < 300000){
            $c1 = "C11";
        }elseif(($pendapatan >= 300000) && ($pendapatan <= 599999)){
            $c1 = "C12";
        }elseif(($pendapatan >= 600000) && ($pendapatan <= 999999)){
            $c1 = "C13";
        }elseif(($pendapatan > 999999)){
            $c1 = "C14";
        }
        $c1 = Subkriteria::where('kode',$c1)->first('id')->id;

        $tanggungan = $calon->jumlah_tanggungan;
        if($tanggungan > 6){
            $c2 = "C21";
        }elseif(($tanggungan >= 5) && ($tanggungan <= 6)){
            $c2 = "C22";
        }elseif(($tanggungan >= 3) && ($tanggungan <= 4)){
            $c2 = "C23";
        }elseif(($tanggungan < 3)){
            $c2 = "C24";
        }
        $c2 = Subkriteria::where('kode',$c2)->first('id')->id;
        
        $pekerjaan = $calon->pekerjaan;
        if($pekerjaan == "Petani"){
            $c3 = "C31";
        }elseif($pekerjaan == "Buruh"){
            $c3 = "C32";
        }elseif($pekerjaan == "Pedagang"){
            $c3 = "C33";
        }elseif($pekerjaan == "Karyawan"){
            $c3 = "C34";
        }
        $c3 = Subkriteria::where('kode',$c3)->first('id')->id;
        
        $umur = Carbon::parse($calon->tanggal_lahir)->age;
        if($umur > 59){
            $c4 = "C41";
        }elseif(($umur >= 50) && ($umur <= 59)){
            $c4 = "C42";
        }elseif(($umur >= 40) && ($umur <= 49)){
            $c4 = "C43";
        }elseif($umur < 40){
            $c4 = "C44";
        }
        $c4 = Subkriteria::where('kode',$c4)->first('id')->id;
        $nilai = NilaiCalon::where('id_calon_penerima',$calon->id)->first();
            $nilai->c1 = $c1; 
            $nilai->c2 = $c2; 
            $nilai->c3 = $c3; 
            $nilai->c4 = $c4; 
        $nilai->save();


        Session::flash('success', 'Data Calon Penerima Bantuan Berhasil Diperbarui');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $calon = CalonPenerima::find($id);
        $calon->delete();
        Session::flash('success', 'Data Calon Penerima Bantuan Berhasil Dihapus');
        return redirect()->back();
    }
}
