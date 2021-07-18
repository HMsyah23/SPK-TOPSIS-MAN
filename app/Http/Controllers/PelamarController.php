<?php

namespace App\Http\Controllers;

use App\Pelamar,App\User,App\SubKriteria, App\NilaiPelamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use Validator;
use Hash;
use Session;

class PelamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelamar  = Pelamar::where('wawancara',null)->where('validasi',1)->get();
        $pelamars = Pelamar::all();
        $sudah = Pelamar::where('validasi',1)->get()->count();
        $belum = Pelamar::where('validasi',0)->get()->count();
        $tidak = Pelamar::where('validasi',2)->get()->count();
        return view('pelamar.index',compact('pelamars','sudah','belum','tidak','pelamar'));
    }

    public function dashboard()
    {
        return view('pelamar.dashboard');
    }

    public function profile()
    {
        return view('pelamar.show');
    }
    
    public function gantiPassword()
    {
        return view('pelamar.password');
    }

    public function ganti(Request $r)
    {
        $user = User::find(Auth::user()->id);
        $rules = [
            'password' => 'required',
            'baru'     => 'required'
        ];

        $messages = [
            'password.required'     => 'Password terdahulu wajib diisi',
            'baru.required'         => 'Password Baru Wajib Diisi'
        ];

        $validator = Validator::make($r->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($r->all);
        }

        if(Hash::check($r->password,$user->password)) {
            $user->update([
                'password' => Hash::make($r->baru),
            ]);

            return redirect()->back()->with('sukses', 'Password Berhasil Diperbarui!');
        } else {
            return redirect()->back()->withErrors('Password Lama Tidak Sesuai! Coba Lagi');
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $r)
    {
        if ($r->pelamar == "null") {
            return redirect()->back()->with('error', 'Data Yang Dimasukkan Tidak Valid');
        } 
    
        $pelamar = Pelamar::find($r->pelamar);
        $nilaipelamar = NilaiPelamar::where('id_pelamar',$r->pelamar)->first();

        if($r->tertulis < 5){
            $c4 = "C41";
        }elseif(($r->tertulis >= 5) && ($r->tertulis <= 6)){
            $c4 = "C42";
        }elseif(($r->tertulis >= 7) && ($r->tertulis <= 8)){
            $c4 = "C43";
        }elseif(($r->tertulis >= 9) && ($r->tertulis <= 10)){
            $c4 = "C44";
        }

        $c4 = Subkriteria::where('kode',$c4)->first('id')->id;
        $nilaipelamar->c4 = $c4;
        $c3 = Subkriteria::where('kondisi',$r->wawancara)->first('id')->id;
        $nilaipelamar->c3 = $c3;

        $nilaipelamar->save();

        $pelamar->tertulis = $r->tertulis;
        $pelamar->wawancara = $r->wawancara;
        $pelamar->save();

        $nama_lengkap = $pelamar->nama_depan.' '.$pelamar->nama_belakang;

        return redirect()->back()->with('sukses', 'Data Hasil Tes Pelamar <strong>'.$nama_lengkap.'</strong> Telah Berhasil Diinput');
    }

    public function show($id)
    {
        $pelamar = Pelamar::find($id);
        return view('pelamar.validasi',compact('pelamar'));
    }

    public function edit(Pelamar $pelamar)
    {
        //
    }

    public function update(Request $request, Pelamar $pelamar)
    {
        //
    }

    public function destroy($id)
    {
        $pelamar = Pelamar::find($id);
        $pelamar->delete();
        return redirect()->back()->with('sukses','Data Berhasil Dihapus');
    }

    public function daftar()
    {
        return view('pelamar.register');
    }

    public function kirim(Request $r)
    {
        $rules = [
            'nama_depan'           => 'required|max:25',
            'nama_belakang'        => 'required|max:50',
            'no_ktp'               => 'required|numeric|min:16|unique:pelamars,no_ktp',
            'jenis_kelamin'        => 'required',
            'tanggal_lahir'        => 'required',
            'email'                => 'required|unique:users,email',
            'no_hp'                => 'required|numeric',
            'asal_sekolah'          => 'required',
            'jurusan'              => 'required',
            'alamat'               => 'required',
            'foto'                 => 'required|max:1024|mimes:jpg,png,jpeg',
            'ktp'                  => 'required|max:1024|mimes:pdf,jpg,png,jpeg',
            'kk'                   => 'required|max:1024|mimes:pdf,jpg,png,jpeg',
            'skck'                 => 'required|max:1024|mimes:pdf,jpg,png,jpeg',
            'akta_kelahiran'       => 'required|max:1024|mimes:pdf,jpg,png,jpeg',
            'ijazah'               => 'required|max:1024|mimes:pdf,jpg,png,jpeg',
        ];
 
        $messages = [
            'nama_depan.required'           => 'Nama Depan wajib diisi',
            'nama_depan.max'                => 'Nama Depan maksimal 50 karakter',
            'nama_belakang.required'        => 'Nama Belakang wajib diisi',
            'nama_belakang.max'             => 'Nama Belakang maksimal 50 karakter',
            'no_ktp.required'               => 'No KTP wajib diisi',
            'no_ktp.unique'                 => 'No KTP Sudah Terdaftar, Mohon input data yang valid',
            'no_ktp.min'                    => 'No KTP Minimal berjumlah 16 Digit',
            'tanggal_lahir.required'        => 'Tanggal Lahir wajib diisi',
            'email.required'                => 'Email wajib diisi',
            'email.unique'                => 'Email Tidak Boleh Sama, Sudah Terdapat Pengguna Yang Mendaftar Dengan Email Tersebut',
            'no_hp.required'                => 'Nomor Handphone wajib diisi',
            'no_hp.numeric'                 => 'Nomor Harus Berupa Angka',
            'alamat.required'               => 'Alamat wajib diisi',
            'foto.required'                 => 'Foto Belum Diunggah',
            'foto.max'                      => 'File Foto melebihi batas maksimal, ukuran maksimal : 1Mb',
            'foto.mimes'                    => 'Format File Foto Salah, Sistem hanya menerima file berformat jpg,png,jpeg',
            'ktp.required'                  => 'File KTP Belum Diunggah',
            'ktp.max'                       => 'File KTP melebihi batas maksimal, ukuran maksimal : 1Mb',
            'ktp.mimes'                     => 'Format File Foto KTP Salah, Sistem hanya menerima file berformat pdf,jpg,png,jpeg',
            'kk.required'                   => 'File KK Belum Diunggah',
            'kk.max'                        => 'File KK melebihi batas maksimal, ukuran maksimal : 1Mb',
            'kk.mimes'                      => 'Format File Foto KK Salah, Sistem hanya menerima file berformat pdf,jpg,png,jpeg',
            'skck.required'                 => 'File SKCK Belum Diunggah',
            'skck.max'                      => 'File SKCK melebihi batas maksimal, ukuran maksimal : 1Mb',
            'skck.mimes'                    => 'Format File Foto SKCK Salah, Sistem hanya menerima file berformat pdf,jpg,png,jpeg',
            'akta_kelahiran.required'       => 'File Akta Kelahiran Belum Diunggah',
            'akta_kelahiran.max'            => 'File Akta Kelahiran melebihi batas maksimal, ukuran maksimal : 1Mb',
            'akta_kelahiran.mimes'          => 'Format File Foto Akta Kelahiran Salah, Sistem hanya menerima file berformat pdf,jpg,png,jpeg',
            'ijazah.required'               => 'Ijazah Belum Diunggah',
            'ijazah.max'                    => 'Ijazah melebihi batas maksimal, ukuran maksimal : 1Mb',
            'ijazah.mimes'                  => 'Format File Ijazah Salah, Sistem hanya menerima file berformat pdf,jpg,png,jpeg',
        ];
 
        $validator = Validator::make($r->all(), $rules, $messages);
 
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($r->all);
        }

        $years = Carbon::parse($r->tanggal_lahir)->age;
        
        if ($years < 18) {
            Session::flash('error', 'Umur Minimal 18 Tahun');
            return redirect()->back()->withInput();
        } elseif ($years > 30) {
            Session::flash('error', 'Umur Maksimal 30 Tahun');
            return redirect()->back()->withInput();
        }

        if($r->jurusan == "Teknik Pendingin"){
            $c1 = "C11";
        }elseif($r->jurusan == "Tata Udara"){
            $c1 = "C12";
        }elseif($r->jurusan == "Teknik Listrik"){
            $c1 = "C13";
        }elseif($r->jurusan == "Teknik Mesin"){
            $c1 = "C14";
        }
        $c1 = Subkriteria::where('kode',$c1)->first()->id;

        if(($years >= 27) && ($years <= 30)){
            $c2 = "C21";
        }elseif(($years >= 24) && ($years <= 26)){
            $c2 = "C22";
        }elseif(($years >= 21) && ($years <= 23)){
            $c2 = "C23";
        }elseif(($years >= 18) && ($years <= 20)){
            $c2 = "C24";
        }
        $c2 = Subkriteria::where('kode',$c2)->first()->id;

        $r->foto->store('pelamar/foto', 'public');
        $r->ktp->store('pelamar/foto_ktp', 'public');
        $r->kk->store('pelamar/foto_kk', 'public');
        $r->skck->store('pelamar/foto_skck', 'public');
        $r->akta_kelahiran->store('pelamar/akta_kelahiran', 'public');
        $r->ijazah->store('pelamar/ijazah', 'public');

        $user = new User;
        $user->name = $r->nama_depan;
        $user->role = 2;
        $user->email = $r->email;
        $user->password = bcrypt('password');
        $user->save();

        $pelamar = new Pelamar;
        $pelamar->id_user = $user->id;
        $pelamar->no_ktp = $r->no_ktp;
        $pelamar->nama_depan = $r->nama_depan;
        $pelamar->nama_belakang = $r->nama_belakang;
        $pelamar->no_hp = $r->no_hp;
        $pelamar->tanggal_lahir = $r->tanggal_lahir;
        $pelamar->usia = $years;
        $pelamar->email = $r->email;
        $pelamar->asal_sekolah = $r->asal_sekolah;
        $pelamar->jurusan = $r->jurusan;
        $pelamar->jenis_kelamin = $r->jenis_kelamin;
        $pelamar->alamat = $r->alamat;
        $pelamar->foto = $r->foto->hashName();
        $pelamar->ktp = json_encode(['file' => $r->ktp->hashName(),'validasi' => 0,'Keterangan' => ""]);
        $pelamar->kk = json_encode(['file' => $r->kk->hashName(),'validasi' => 0,'Keterangan' => ""]);
        $pelamar->skck = json_encode(['file' => $r->skck->hashName(),'validasi' => 0,'Keterangan' => ""]);
        $pelamar->akta_kelahiran = json_encode(['file' => $r->akta_kelahiran->hashName(),'validasi' => 0,'Keterangan' => ""]);
        $pelamar->ijazah = json_encode(['file' => $r->ijazah->hashName(),'validasi' => 0,'Keterangan' => ""]);
        $pelamar->validasi     = 0;
        $pelamar->tertulis = null;
        $pelamar->wawancara    = null;
        $simpan = $pelamar->save();

        $nilaPelamar = new NilaiPelamar;
        $nilaPelamar->id_pelamar = $pelamar->id;
        $nilaPelamar->c1 = $c1;
        $nilaPelamar->c2 = $c2;
        $nilaPelamar->save();
    
            $nama_lengkap = $r->nama_depan.' '.$r->nama_belakang;
        if($simpan){
            return redirect()->back()->with('sukses', $nama_lengkap);
        } else {
            Session::flash('errors', ['' => 'Data Gagal Ditambahkan! Silahkan ulangi beberapa saat lagi']);
            return redirect()->back();
        }
    }

    public function validasi(Request $r, $id)
    {
        $pelamar = Pelamar::find($id);
        $pelamar->validasi = $r->valid;
        $pelamar->save();
        return redirect()->route('admin.dashboard')->with('sukses','Data Berhasil Divalidasi');
    }
}
