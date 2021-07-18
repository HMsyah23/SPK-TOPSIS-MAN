<?php

namespace App\Http\Controllers;

use App\CalonPenerima,App\User,App\Kriteria,App\Subkriteria,App\NilaiCalon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $calons = CalonPenerima::all();
        $users = User::all();
        $kriterias = Kriteria::all();
        return view('admin.index',compact('calons','users','kriterias'));
    }

    public function rank()
    {
        $kriterias = Kriteria::all();
        $subkriterias = Subkriteria::all();

        $k1 = $kriterias[0]->bobot;
        $k2 = $kriterias[1]->bobot;
        $k3 = $kriterias[2]->bobot;
        $k4 = $kriterias[3]->bobot;

        foreach ($kriterias as $key => $value) {
            $perbaikan = $value->bobot / ($k1 + $k2 + $k3 + $k4);
            $bobot['perbaikan'][$value->kode]['bobot'] = $perbaikan;
            $bobot['perbaikan'][$value->kode]['nilai'] = $value->bobot;
        }

        $data = NilaiCalon::whereNotNull('C3')->get();

        // $data['id_supplier'] = $supplier->id;
        // $data['nama'] = $supplier->nama;
        // $data['no_hp'] = $supplier->no_hp;
        // $data['alamat'] = $supplier->alamat;
        $param1 = 0;
        $param2 = 0;
        $param3 = 0;
        $param4 = 0;
        foreach ($data as $calon) {
            $param1 = ($calon->c1->nilai * $calon->c1->nilai) + $param1;
            $param2 = ($calon->c2->nilai * $calon->c2->nilai) + $param2;
            $param3 = ($calon->c3->nilai * $calon->c3->nilai) + $param3;
            $param4 = ($calon->c4->nilai * $calon->c4->nilai) + $param4;
        }

        foreach ($data as $key => $value) {
            $value['nama'] = $value->calon->nama_kepala_keluarga;
            $value['id'] = $value->calon->id;
            $value['no_ktp'] = $value->calon->no_ktp;
            $value['nik'] = $value->calon->nik;
            $value['pendapatan'] = $value->calon->pendapatan_kepala_keluarga;
            $value['tanggungan'] = $value->calon->jumlah_tanggungan;
            $value['pekerjaan'] = $value->calon->pekerjaan;
            $value['usia'] = Carbon::parse($value->calon->tanggal_lahir)->age;
            $value['alamat'] = $value->calon->alamat;
            $value['O_C1'] = $value->c1->nilai;
            $value['O_C2'] = $value->c2->nilai;
            $value['O_C3'] = $value->c3->nilai;
            $value['O_C4'] = $value->c4->nilai;
            $value['N_C1'] = $value->c1->nilai / sqrt($param1);
            $value['N_C2'] = $value->c2->nilai / sqrt($param2);
            $value['N_C3'] = $value->c3->nilai / sqrt($param3);
            $value['N_C4'] = $value->c4->nilai / sqrt($param4);
            $value['C1'] = $value->c1->nilai / sqrt($param1) * $k1;
            $value['C2'] = $value->c2->nilai / sqrt($param2) * $k2;
            $value['C3'] = $value->c3->nilai / sqrt($param3) * $k3;
            $value['C4'] = $value->c4->nilai / sqrt($param4) * $k4;
            // $value['normalisasi'][$key] = $value;
        }
        
        // dd($data);

        // dd($data);

        foreach ($kriterias as $key => $value) {
            $max = 0;
            $min = 3;
            foreach ($data as $key => $s) {
                if($s[$value->kode] > $max){
                    $max = $s[$value->kode];
                }
                if($s[$value->kode] < $min){
                    $min = $s[$value->kode];
                }
            }
            $bobot['perbaikan'][$value->kode]['max'] = $max;
            $bobot['perbaikan'][$value->kode]['min'] = $min;
        }

        // dd($bobot);

        foreach ($data as $key => $s) {
            
            $data[$key]['A_max'] = sqrt(pow(($bobot['perbaikan']['C1']['max'] - floatval($data[$key]['C1'])),2)
                                                    + pow(($bobot['perbaikan']['C2']['min'] - floatval($data[$key]['C2'])),2) 
                                                    + pow(($bobot['perbaikan']['C3']['max'] - floatval($data[$key]['C3'])),2)
                                                    + pow(($bobot['perbaikan']['C4']['max'] - floatval($data[$key]['C4'])),2));
            $data[$key]['A_min'] = sqrt(pow((floatval($data[$key]['C1']) - $bobot['perbaikan']['C1']['min']),2)
                                                    + pow((floatval($data[$key]['C2']) - $bobot['perbaikan']['C2']['max']),2) 
                                                    + pow((floatval($data[$key]['C3']) - $bobot['perbaikan']['C3']['min']),2)
                                                    + pow((floatval($data[$key]['C4']) - $bobot['perbaikan']['C4']['min']),2));
            if ($data[$key]['A_min'] == 0 && $data[$key]['A_max'] == 0) {
                $data[$key]['preferensi'] = 0;
                Session::flash('sama', "Perhitungan TOPSIS Berjalan Tidak Wajar Karena Seluruh Variabel Memiliki Data Yang Sama");
            } else {
                $data[$key]['preferensi'] = floatval($data[$key]['A_min']) / ( floatval($data[$key]['A_min']) + floatval($data[$key]['A_max']) );
            }   
        }

        $rank = $data->sortByDesc('preferensi');

        return view('topsis.index',compact('data','bobot','kriterias','rank','subkriterias'));
    }

    public function topsis()
    {
        $kriterias = Kriteria::all();
        $subkriterias = Subkriteria::all();

        $k1 = $kriterias[0]->bobot;
        $k2 = $kriterias[1]->bobot;
        $k3 = $kriterias[2]->bobot;
        $k4 = $kriterias[3]->bobot;

        foreach ($kriterias as $key => $value) {
            $perbaikan = $value->bobot / ($k1 + $k2 + $k3 + $k4);
            $bobot['perbaikan'][$value->kode]['bobot'] = $perbaikan;
            $bobot['perbaikan'][$value->kode]['nilai'] = $value->bobot;
        }

        $data = NilaiCalon::whereNotNull('C3')->get();

        $param1 = 0;
        $param2 = 0;
        $param3 = 0;
        $param4 = 0;
        foreach ($data as $calon) {
            $param1 = ($calon->c1->nilai * $calon->c1->nilai) + $param1;
            $param2 = ($calon->c2->nilai * $calon->c2->nilai) + $param2;
            $param3 = ($calon->c3->nilai * $calon->c3->nilai) + $param3;
            $param4 = ($calon->c4->nilai * $calon->c4->nilai) + $param4;
        }

        foreach ($data as $key => $value) {
            $value['nama'] = $value->calon->nama_kepala_keluarga;
            $value['no_ktp'] = $value->calon->no_ktp;
            $value['O_C1'] = $value->c1->nilai;
            $value['O_C2'] = $value->c2->nilai;
            $value['O_C3'] = $value->c3->nilai;
            $value['O_C4'] = $value->c4->nilai;
            $value['N_C1'] = $value->c1->nilai / sqrt($param1);
            $value['N_C2'] = $value->c2->nilai / sqrt($param2);
            $value['N_C3'] = $value->c3->nilai / sqrt($param3);
            $value['N_C4'] = $value->c4->nilai / sqrt($param4);
            $value['C1'] = $value->c1->nilai / sqrt($param1) * $k1;
            $value['C2'] = $value->c2->nilai / sqrt($param2) * $k2;
            $value['C3'] = $value->c3->nilai / sqrt($param3) * $k3;
            $value['C4'] = $value->c4->nilai / sqrt($param4) * $k4;
            // $value['normalisasi'][$key] = $value;
        }
        
        // dd($data);

        // dd($data);

        foreach ($kriterias as $key => $value) {
            $max = 0;
            $min = 3;
            foreach ($data as $key => $s) {
                if($s[$value->kode] > $max){
                    $max = $s[$value->kode];
                }
                if($s[$value->kode] < $min){
                    $min = $s[$value->kode];
                }
            }
            $bobot['perbaikan'][$value->kode]['max'] = $max;
            $bobot['perbaikan'][$value->kode]['min'] = $min;
        }

        // dd($bobot);

        foreach ($data as $key => $s) {
            
            $data[$key]['A_max'] = sqrt(pow(($bobot['perbaikan']['C1']['min'] - floatval($data[$key]['C1'])),2)
                                                    + pow(($bobot['perbaikan']['C2']['max'] - floatval($data[$key]['C2'])),2) 
                                                    + pow(($bobot['perbaikan']['C3']['max'] - floatval($data[$key]['C3'])),2)
                                                    + pow(($bobot['perbaikan']['C4']['min'] - floatval($data[$key]['C4'])),2));
            $data[$key]['A_min'] = sqrt(pow((floatval($data[$key]['C1']) - $bobot['perbaikan']['C1']['max']),2)
                                                    + pow((floatval($data[$key]['C2']) - $bobot['perbaikan']['C2']['min']),2) 
                                                    + pow((floatval($data[$key]['C3']) - $bobot['perbaikan']['C3']['min']),2)
                                                    + pow((floatval($data[$key]['C4']) - $bobot['perbaikan']['C4']['max']),2));
            if ($data[$key]['A_min'] == 0 && $data[$key]['A_max'] == 0) {
                $data[$key]['preferensi'] = 0;
                Session::flash('sama', "Perhitungan TOPSIS Berjalan Tidak Wajar Karena Seluruh Variabel Memiliki Data Yang Sama");
            } else {
                $data[$key]['preferensi'] = floatval($data[$key]['A_min']) / ( floatval($data[$key]['A_min']) + floatval($data[$key]['A_max']) );
            }   
        }

        $rank = $data->sortByDesc('preferensi');

        return view('topsis.detail',compact('data','bobot','kriterias','rank','subkriterias'));
    }
}
