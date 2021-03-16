<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
use Carbon\Carbon;
use App\Traits\DateTraits;
use PDF;

use App\Report;
use App\Absensi;
use App\Aplikasi;
use App\Events\RealtimeReport;

class ReportController extends Controller
{
    use DateTraits;

    public function index()
    {
        $tgl = Date('Y-m-d');
        $absensi = Absensi::whereDate('tanggal', $tgl)->where( 'id_pegawai', auth()->id())->first();
        $exist = is_null($absensi) ? false :true;
        if ( Auth::user()->level == 'pegawai' ) {

            $data   =   Report::with(['absensi'])
                ->join('absensi', 'absensi.id', 'report.id_absensi')
                ->join('pegawai', 'pegawai.id', 'absensi.id_pegawai')
                ->selectRaw("report.*, pegawai.nik, pegawai.id as id_pegawai, pegawai.nama, absensi.tanggal, MONTH(absensi.tanggal) as bulan, YEAR(absensi.tanggal) as tahun")
                ->where( 'pegawai.id', auth()->id() )
                ->whereDate('absensi.tanggal', "'$tgl'")
                ->orderBy('absensi.tanggal', 'desc')->get();
        }else{
            $data   =   Report::with(['absensi'])
                ->join('absensi', 'absensi.id', 'report.id_absensi')
                ->join('pegawai', 'pegawai.id', 'absensi.id_pegawai')
                ->selectRaw("report.*, pegawai.nik, pegawai.id as id_pegawai, pegawai.nama, absensi.tanggal, MONTH(absensi.tanggal) as bulan, YEAR(absensi.tanggal) as tahun")
                ->orderBy('absensi.tanggal', 'desc')->get();
        }    
        $yearMonth = $this->getYearMonth();
        return view('report.index', compact('data','tgl', 'absensi', 'yearMonth', 'exist'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 

        return view('report.add', compact('data'));
    }

    public function store(Request $request)
    {
        $data = (array) $request->except(['submit']);
        $report = Report::create($data);
        //broadcast(new RealtimeReport($report));//->toOthers()
        event(new RealtimeReport($report));

        Session::flash('message', 'Report berhasil ditambahkan!');
        Session::flash('message_type', 'success');
        return redirect('/report');
    }
    
    public function edit($id)
    {
        $report = Report::orderBy('nama', 'asc')->get();
        if (Auth::user()->level == 'pegawai') {
            return back();
        }else{
            $data = Report::where('id', $id)->get();
            return view('report.edit', compact('data' ));
        }
    }

    public function update(Request $request, $id)
    {
        $data = (array) $request->except(['id','submit']);
        
        Report::find($id)->update($data);
        return redirect('/report');
    }
    
    public function delete($id)
    {
        Report::find($id)->delete();

        Session::flash('message', 'Report berhasil dihapus!');
        Session::flash('message_type', 'success');
        return back();
    }
}
