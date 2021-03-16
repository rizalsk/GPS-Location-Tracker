<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
use Carbon\Carbon;
use App\Pegawai;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class PegawaiController extends Controller
{
    use AuthenticatesUsers;
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->level == 'pegawai') {
            return back();
        }else{
            $data   =   Pegawai::orderBy('nama', 'asc')->get();

            return view('admin.pegawai.index', compact('data'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->level == 'pegawai') {
            return back();
        }else{
            $pegawai = Pegawai::orderBy('nik', 'desc')->first();
            $nik = is_null($pegawai) ? "0001" : str_pad( ( $pegawai->nik + 1) , 4,"0" , STR_PAD_LEFT)  ;
            return view('admin.pegawai.tambah', compact('nik') );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = (array) $request->except(['password','foto']);
        $password = bcrypt($request->username);
        $data['password'] = $password;
        if($request->has('foto')){
            $data['foto'] = $this->upload($request);
        }

        $data = array_merge($data, [ 'password' => $password ] );
        Pegawai::create($data);

        return redirect('/pegawai');
    }

    public function biodata()
    {
        if (Auth::user()->level == 'hrd' ) {
            return back();
        }else{
            return view('biodata.edit');
        }
    }

    public function updateBiodata($id,Request $request)
    {
        $data = (array) $request->except(['_token','submit','password','foto','password_confirmation']);
        if($request->has('password')){
            $password = bcrypt($request->password);
            $data['password'] = $password;
        }

        if($request->has('foto')){
            $data['foto'] = $this->upload($request);
        }

        Pegawai::where('id',$id)->update($data);

        Session::flash('message', 'Biodata berhasil terupdate!');
        Session::flash('alert-class', 'alert-success');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->level == 'pegawai') {
            return back();
        }else{
            $pegawai      = Pegawai::where('id', $id)->get();
            return view('admin.pegawai.edit', compact('pegawai'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = (array) $request->except(['id', 'foto']);

        if($request->has('foto')){
            $data['foto'] = $this->upload($request);
        }
        
        Pegawai::find($id)->update($data);
        return redirect('/pegawai');
    }

   


    public function updatePassword(Request $request, $id)
    {
        $password = bcrypt($request->password);
        $user->update(['password' => $password]);

        Session::flash('message', 'password berhasil terupdate!');
        Session::flash('alert-class', 'success');
        return redirect('/pegawai');
    }

    public function resetPassword(Request $request, $id)
    {
        $user = User::find($id);
        $password = bcrypt($user->username);
        $user->update(['password' => $password]);
        return redirect('/pegawai');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Pegawai::find($id)->delete();

        Session::flash('message', 'Pegawai berhasil dihapus!');
        Session::flash('message_type', 'success');
        return back();
    }

    public function upload(Request $request)
    {
        $file = $request->file('foto');
        $dt = Carbon::now();
        $acak  = $file->getClientOriginalExtension();
        $fileName = 'Pegawai'.'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
        $request->file('foto')->move("img/pegawai/", $fileName);
        $image = $fileName;
        return $fileName;
    }
}
