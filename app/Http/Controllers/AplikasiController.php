<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Session;
use App\Aplikasi;
use Carbon\Carbon;
class AplikasiController extends Controller
{
    public function index(){
        return view('admin.aplikasi.index');
    }

    public function update($id, Request $request){
    	$data = (array) $request->except(['id','submit','_token']);

    	if($request->has('logo')){
    		$data['logo'] = $this->upload($request);
    	}
    	
    	Aplikasi::where('id', $id)->update($data);
    	Session::flash('message', 'Aplikasi telah terupdate!');
    	Session::flash('message_type', 'success');
    	Session::flash('alert-class', 'alert-success'); 
    	return back();
    }

    public function upload(Request $request)
    {
        $file = $request->file('logo');
        $dt = Carbon::now();
        $acak  = $file->getClientOriginalExtension();
        $fileName = 'Logo'.'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
        $request->file('logo')->move("img/", $fileName);
        $image = $fileName;
        return $fileName;
    }
}
