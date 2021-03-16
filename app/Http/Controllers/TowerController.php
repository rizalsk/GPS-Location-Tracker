<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;

use App\Tower;


class TowerController extends Controller
{

    public function index()
    {
        if (Auth::user()->level == 'pegawai') {
            return back();
        }else{
            $data = Tower::orderBy('nama', 'asc')->get();
            return view('admin.tower.index', compact('data'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.tower.add', compact('data'));
    }

    public function store(Request $request)
    {
        $data = (array) $request->except(['submit']);
        Tower::create($data);

        Session::flash('message', 'Tower berhasil ditambahkan!');
        Session::flash('message_type', 'success');
        return redirect('/tower');
    }
    
    public function edit($id)
    {
        $tower = Tower::orderBy('nama', 'asc')->get();
        if (Auth::user()->level == 'pegawai') {
            return back();
        }else{
            $data = Tower::where('id', $id)->get();
            return view('admin.tower.edit', compact('data' ));
        }
    }

    public function update(Request $request, $id)
    {
        $data = (array) $request->except(['id','submit']);
        
        Tower::find($id)->update($data);
        return redirect('/tower');
    }
    
    public function delete($id)
    {
        Tower::find($id)->delete();

        Session::flash('message', 'Tower berhasil dihapus!');
        Session::flash('message_type', 'success');
        return back();
    }

}
