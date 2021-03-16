<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
use Carbon\Carbon;
use App\Traits\DateTraits;
use PDF;

use App\Gaji;
use App\Aplikasi;

class GajiController extends Controller
{
    use DateTraits;

    public function index()
    {
        if ( Auth::user()->level == 'pegawai' ) {
            $data   =   Gaji::where('id_pegawai', auth()->id() )
                ->join('pegawai', 'pegawai.id', '=', 'gaji.id_pegawai')
                ->select('gaji.*', 'pegawai.nama as nama_pegawai', 'pegawai.nik')
                ->orderBy('nama', 'asc')->get();
        }else{
            $data   =   Gaji::join('pegawai', 'pegawai.id', '=', 'gaji.id_pegawai')
                ->select('gaji.*', 'pegawai.nama as nama_pegawai', 'pegawai.nik')
                ->orderBy('nama', 'asc')->get();
        }    

        return view('gaji.index', compact('data'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = [];
        $periode = [];
        if($request->has('bulan') && $request->has('tahun') ){
            $tahun = $request->tahun;
            $bulan = $request->bulan;
            $awal = "$tahun-$bulan-01";
            $awalTime = strtotime( $awal );
            $akhir =  date("Y-m-t", $awalTime);
            $akhirTime =  strtotime($akhir);
            $namaBulan =  date("F", $awalTime);
            $periode = [
                'bulan' => $bulan,
                'tahun' => $tahun,
                'nama_bulan' => $namaBulan,
                'tanggal' => $awal,
            ];

            $q = "
                SELECT pegawai.*,pegawai.id as id_pegawai, $tahun AS tahun, $bulan AS bulan,
                (( pegawai.bpjs_kesehatan / 100 ) * pegawai.gaji_pokok ) AS total_bpjs_kesehatan,
                (( pegawai.bpjs_tk / 100 ) * pegawai.gaji_pokok ) AS total_bpjs_tk,
                (( pegawai.bpjs_jht / 100 ) * pegawai.gaji_pokok ) AS total_bpjs_jht,
                (
                    pegawai.gaji_pokok - 
                    (
                        (( pegawai.bpjs_kesehatan / 100 ) * pegawai.gaji_pokok ) + 
                        (( pegawai.bpjs_tk / 100 ) * pegawai.gaji_pokok ) + 
                        (( pegawai.bpjs_jht / 100 ) * pegawai.gaji_pokok ) 
                    )
                
                )as total_gaji,
                absensi.hari_kerja,
                absensi.hari_izin,
                absensi.hari_sakit,
                absensi.hari_cuti

                FROM pegawai 
                JOIN(
                    SELECT absensi.id_pegawai, 
                    SUM( IF(absensi.status = 'hadir', 1, 0) ) AS hari_kerja, 
                    SUM( IF(absensi.status = 'izin', 1, 0) ) AS hari_izin, 
                    SUM( IF(absensi.status = 'sakit', 1, 0) ) AS hari_sakit, 
                    SUM( IF(absensi.status = 'cuti', 1, 0) ) AS hari_cuti  
                    FROM absensi
                    WHERE MONTH(absensi.tanggal) = $bulan AND YEAR(absensi.tanggal) = $tahun
                    GROUP BY absensi.id_pegawai
                ) AS absensi ON absensi.id_pegawai = pegawai.id

                LEFT JOIN(
                    SELECT gaji.id_pegawai, GROUP_CONCAT(id_pegawai) as group_id 
                     FROM gaji WHERE bulan = $bulan AND tahun = $tahun GROUP BY gaji.id_pegawai
                ) as gaji ON gaji.id_pegawai = pegawai.id


                WHERE pegawai.level <> 'developer' AND pegawai.id NOT IN(IFNULL(gaji.group_id,0) ) ORDER BY pegawai.nama ASC
            ";

            $data = DB::select($q);
        }

        //return dd($data);

        $yearMonth = $this->getYearMonth();
        return view('gaji.add', compact('data', 'yearMonth','periode' ));
    }

    public function store(Request $request)
    {
        $data = (array) $request->except(['submit','_token']);
        $store = [];
        foreach ( $request->id_pegawai as $i => $v) {

            $gaji = [
                "id_pegawai" => $request->id_pegawai[$i],
                "bulan" => $request->bulan[$i],
                "tahun" => $request->tahun[$i],
                "gaji_pokok" => $request->gaji_pokok[$i],
                "hari_kerja" => $request->hari_kerja[$i],
                "hari_izin" => $request->hari_izin[$i],
                "hari_sakit" => $request->hari_sakit[$i],
                "hari_cuti" => $request->hari_cuti[$i],
                "bpjs_kesehatan" => $request->bpjs_kesehatan[$i],
                "bpjs_tk" => $request->bpjs_tk[$i],
                "bpjs_jht" => $request->bpjs_jht[$i],
                "potongan_lain" => $request->potongan_lain[$i],
                "bonus" => $request->bonus[$i],
                "total" => $request->total[$i],
                "keterangan" => $request->keterangan[$i],
            ];
            $store[] = $gaji;
        }
        
        //return dd($store);

        Gaji::insert($store);

        Session::flash('message', 'Gaji berhasil ditambahkan!');
        Session::flash('message_type', 'success');
        return redirect('/gaji');
    }
    
    public function edit($id)
    {
        //$gaji = Gaji::with('pegawai')->orderBy('nama', 'asc')->get();
        if (Auth::user()->level == 'pegawai') {
            return back();
        }else{
            $data = Gaji::with('pegawai')->where('id', $id)->get();
            return view('gaji.edit', compact('data' ));
        }
    }

    public function update(Request $request, $id)
    {
        $data = (array) $request->except(['id','submit']);
        
        Gaji::find($id)->update($data);
        return redirect('/gaji');
    }
    
    public function delete($id)
    {
        Gaji::find($id)->delete();

        Session::flash('message', 'Gaji berhasil dihapus!');
        Session::flash('message_type', 'success');
        return back();
    }

    public function slip($id)
    {
        $aplikasi = Aplikasi::first();
        $data = Gaji::with('pegawai')->where('id', $id)->first();
        $date = $data->tahun."-".$data->bulan."-01";
        $strtotime = strtotime($date);
        $namaBulan = Date('F', $strtotime);
        //return view('gaji.slip', compact('data','namaBulan' ));
        //$pdf = PDF::loadview('gaji.slip', compact('data', 'namaBulan','aplikasi'));
        $pdf = PDF::loadview('gaji.slip', compact('data', 'namaBulan','aplikasi'))->stream('Slip Gaji '.$data->pegawai->nama.' '.$namaBulan.' '.$data->tahun.'.pdf');
        return $pdf;
        return $pdf->download('Slip Gaji '.$data->pegawai->nama.' '.$namaBulan.' '.$data->tahun.'.pdf');
    }
}
