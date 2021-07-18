<?php

namespace App\Http\Controllers;

use App\user;
use Validator;
use Hash;
use Session;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index',compact('users'));
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    public function store(Request $r)
    {
        $r->validate([
            'email'             => 'required|unique:users,email',
            'password'          => 'required',
            'name'              => 'required',
            'role'              => 'required',
        ]);
        
        $user = User::create([
            'name' => $r->name, 
            'role' => $r->role, 
            'email' => $r->email, 
            'password' => Hash::make($r->password),
        ]);

        Session::flash('success', 'Data Pengguna Berhasil Ditambahkan');
        return redirect()->back();
    }

    public function ganti(Request $r,$id)
    {
        $user = User::find($id);
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

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        Session::flash('success', 'Data Pengguna Berhasil Dihapus');
        return redirect()->back();
    }
}
