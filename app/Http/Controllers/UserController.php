<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use App\Ujian;
use App\Daftar;
use App\Kejuruan;
use App\User;
use App\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->level == 'calon') {
            return back();
        }else{
            $calon       = User::where('level', 'calon')->orderBy('id', 'desc')->get();

            $data   = DB::table('ujian')
                    ->join('users', 'ujian.user_id', '=', 'users.id')               // ambil nama user
                    ->select('users.id', 'nama', 'email', 'username', 'nilai_wawancara')
                    ->orderBy('users.id', 'desc')
                    ->where('level', 'calon')
                    ->get();

            return view('admin.users.calon.index', compact('calon', 'data'));
        }
    }

    public function tambahCalon()
    {
        if (Auth::user()->level == 'calon') {
            return back();
        }else{
            return view('admin.users.calon.tambah');
        }
    }

    public function editCalon($id)
    {
        if (Auth::user()->level == 'calon') {
            return back();
        }else{
            $calon      = User::where('id', $id)->get();
            return view('admin.users.calon.edit', compact('calon'));
        }
    }

    public function addCalon(Request $request)
    {
        User::create([
            'nama'      => $request->input('nama'),
            'email'     => $request->input('email'),
            'username'  => $request->input('username'),
            'password'  => Hash::make($request->input('username')),
            'level'     => 'calon',
        ]);

        return redirect('/users');
    }

    public function updateCalon(Request $request, $id)
    {
        User::find($id)->update([
            'nama'      => $request->input('nama'),
            'email'     => $request->input('email'),
            'username'  => $request->input('username'),
        ]);
        return redirect('/users');
    }


    public function pegawai()
    {
        if (Auth::user()->level == 'calon') {
            return back();
        }else{
            $pegawai     = User::where('level', 'pegawai')->orderBy('id', 'desc')->get();

            return view('admin.users.pegawai.index', compact('pegawai'));
        }
    }

    public function tambahPegawai()
    {
        if (Auth::user()->level == 'calon') {
            return back();
        }else{
            return view('admin.users.pegawai.tambah');
        }
    }

    public function editPegawai($id)
    {
        if (Auth::user()->level == 'calon') {
            return back();
        }else{
            $pegawai      = User::where('id', $id)->get();
            return view('admin.users.pegawai.edit', compact('pegawai'));
        }
    }

    public function addPegawai(Request $request)
    {
        User::create([
            'nama'      => $request->input('nama'),
            'email'     => $request->input('email'),
            'telepon'   => $request->input('telepon'),
            'nik'       => $request->input('nik'),
            'jabatan'   => $request->input('jabatan'),
            'alamat'    => $request->input('alamat'),
            'username'  => $request->input('username'),
            'password'  => Hash::make($request->input('username')),
            'level'     => 'pegawai',
        ]);
        return redirect('/users/pegawai');
    }

    public function updatePegawai(Request $request, $id)
    {
        User::find($id)->update([
            'nama'      => $request->input('nama'),
            'email'     => $request->input('email'),
            'telepon'   => $request->input('telepon'),
            'nik'       => $request->input('nik'),
            'jabatan'   => $request->input('jabatan'),
            'alamat'    => $request->input('alamat'),
            'username'  => $request->input('username'),
        ]);
        if(Auth::user()->level == 'admin') {
            return redirect('/users/pegawai');
        } else {
            return redirect('/users/biodata');
        }
    }



    public function peserta()
    {
        if (Auth::user()->level == 'calon') {
            return back();
        }else{
            $data   = DB::table('ujian')
                    ->join('tes', 'tes.id', '=', 'ujian.tes_id')                    // ambil nilai id tes
                    ->join('kejuruan', 'tes.kejuruan_id', '=', 'kejuruan.id')       // ambil nama kejuruan
                    ->join('users', 'ujian.user_id', '=', 'users.id')               // ambil nama user
                    ->select('kejuruan.kejuruan', 'kategori', 'users.nama', 'ujian.id', 'nilai', 'nilai_wawancara')
                    ->orderBy('kejuruan.kejuruan', 'asc')
                    ->orderBy('ujian.id', 'desc')
                    ->get();
            $kategori = Kejuruan::get();

            return view('admin.users.Peserta.index', compact('data', 'kategori'));
        }
    }

    public function editTenagakerja($id)
    {
        if (Auth::user()->level == 'calon') {
            return back();
        }else{
            $tenagakerja      = User::where('id', $id)->get();
            return view('admin.users.Peserta.edit', compact('peserta'));
        }
    }

    public function updateTenagakerja(Request $request, $id)
    {
        User::find($id)->update([
            'nama'      => $request->input('nama'),
            'email'     => $request->input('email'),
            'telepon'   => $request->input('telepon'),
            'username'  => $request->input('username'),
        ]);
        return redirect('/users/Peserta');
    }


    public function delete($id)
    {
        User::find($id)->delete();
        return back();
    }

    public function biodata() {
        if (Auth::user()->level != 'pegawai') {
            return back();
        }else{

            return view('pegawai.biodata.index');
        }
    }

}