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

class LaporanController extends Controller
{
	use DateTraits;

	public function getDataGaji(Request $request){
		$data = [];
		$periode = [];
		$where = "TRUE ";
		if( $request->has('bulan') && $request->has('tahun') ){
			$tahun = $request->tahun;
		    $bulan = $request->bulan; 
		    $where .= $bulan <> "" ? "AND gaji.bulan = $bulan" : "";
		    $where .= $tahun <> "" ? "AND gaji.tahun = $tahun" : "";
		} else {
		    $where .= "";
		}

		$q = "
		    SELECT gaji.tahun, MONTHNAME( CONCAT( gaji.tahun,'-',gaji.bulan,'-01') ) as nama_bulan, gaji.bulan,
		    SUM(gaji.gaji_pokok) as gaji_pokok, 
		    SUM(gaji.bpjs_kesehatan) as bpjs_kesehatan, 
		    SUM(gaji.bpjs_tk) as bpjs_tk, 
		    SUM(gaji.bpjs_jht) as bpjs_jht, 
		    SUM(gaji.potongan_lain) as potongan_lain,
		    SUM(gaji.potongan_lain) as bonus,
		    SUM(gaji.hari_kerja) as hari_kerja, 
		    SUM(gaji.hari_izin) as hari_izin,
		    SUM(gaji.hari_sakit) as hari_sakit,
		    SUM(gaji.hari_cuti) as hari_cuti,
		    SUM(gaji.total) as total
		    FROM gaji 
		    WHERE $where GROUP BY gaji.tahun, gaji.bulan ORDER BY gaji.tahun, gaji.bulan ASC
		";

		$data = DB::select($q);
		return $data;
	}
    public function gaji(Request $request){
    	$data = [];
    	$periode = [];
    	$where = "TRUE";
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
    	}

    	$data = $this->getDataGaji($request);
    	$yearMonth = $this->getYearMonth();
    	return view('admin.laporan.gaji', compact('data', 'yearMonth','periode' ));

    }

    public function printGaji(Request $request)
    {
        $data = $this->getDataGaji($request);
        $aplikasi = Aplikasi::first();

        //return view('admin.laporan.print_gaji', compact('data','aplikasi'));
        $pdf = PDF::loadview('admin.laporan.print_gaji', compact('data','aplikasi'))->stream('Laporan Gaji.pdf');
        return $pdf;
    }

}
