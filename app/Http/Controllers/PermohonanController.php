<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
use Carbon\Carbon;

use App\Pegawai;
use App\Permohonan;
use App\Absensi;

class PermohonanController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }


    public function index()
    {
        if ( Auth::user()->level == 'pegawai' ) {
            $data   =   Permohonan::with('pegawai')->where('id_pegawai', auth()->id() )->orderBy('mulai_tgl', 'asc')->get();
        }else{
            $data   =   Permohonan::with('pegawai')->orderBy('mulai_tgl', 'asc')->get();

        }
        $tgl = Date('Y-m-d');
        return view('permohonan.index', compact('data','tgl'));
    }


    public function status($stt, $id)
    {
        $data = [ 'status' => $stt];
        $permohonan = Permohonan::find($id);
        if( $stt == 'diterima' ){
            $dt = Carbon::now();
            $date = $dt->format('Y-m-d H:i:s');
            $tgl = $dt->format('Y-m-d');
            $jam = $dt->format('H-m-d');
           

            //$mulai = Carbon::createFromFormat('Y-m-d', '1975-05-21 22')->toDateTimeString();
            $mulaiAsli = Carbon::createFromFormat('Y-m-d', $permohonan->mulai_tgl );
            $mulai = Carbon::createFromFormat('Y-m-d', $permohonan->mulai_tgl );
            $sampai = Carbon::createFromFormat('Y-m-d', $permohonan->sampai_tgl );

            $diff = $mulai->diffInDays( $sampai ); 
            $dataAbsen = [];
            while ( $diff >= 0 ) {
                $dataAbsen[] = [
                    'id_permohonan' => $id,
                    'id_pegawai' => $permohonan->id_pegawai,
                    'tanggal' => $mulai->format('Y-m-d') ,
                    'status' => $permohonan->jenis ,
                ];

                $mulai->addDays(1);
                $diff--;
            } 
            Absensi::insert($dataAbsen);
        }
        //return response()->json( $response ,201);

        $permohonan->update($data);
        return back();
    }

    public function store(Request $request)
    {
        $data = (array) $request->except(['id', 'foto']);
        if($request->has('foto')){
            $data['foto'] = $this->upload($request);
        }
        Permohonan::create($data);

        Session::flash('message', 'Permohonan berhasil ditambahkan!');
        Session::flash('message_type', 'success');
        return back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function delete($id)
    {
        //
    }

    public function upload(Request $request)
    {
        $file = $request->file('foto');
        $dt = Carbon::now();
        $acak  = $file->getClientOriginalExtension();
        $fileName = 'Permohonan'.'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
        $request->file('foto')->move("img/permohonan/", $fileName);
        $image = $fileName;

        return $fileName;
    }
}
