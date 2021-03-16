<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;

use App\Kantor;
class KantorController extends Controller
{
    public function index()
    {
        if (Auth::user()->level == 'pegawai') {
            return back();
        }else{
            $data = Kantor::orderBy('nama', 'asc')->get();
            return view('admin.kantor.index', compact('data'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        return view('admin.kantor.add', compact('data'));
    }

    public function store(Request $request)
    {
        $data = (array) $request->except(['submit']);
        Kantor::create($data);

        Session::flash('message', 'Kantor berhasil ditambahkan!');
        Session::flash('message_type', 'success');
        return redirect('/kantor');
    }
    
    public function edit($id)
    {
        $kantor = Kantor::orderBy('nama', 'asc')->get();
        if (Auth::user()->level == 'pegawai') {
            return back();
        }else{
            $data = Kantor::where('id', $id)->get();
            return view('admin.kantor.edit', compact('data' ));
        }
    }

    public function update(Request $request, $id)
    {
        $data = (array) $request->except(['id','submit']);
        
        Kantor::find($id)->update($data);
        return redirect('/kantor');
    }
    
    public function delete($id)
    {
        Kantor::find($id)->delete();

        Session::flash('message', 'Kantor berhasil dihapus!');
        Session::flash('message_type', 'success');
        return back();
    }
}
