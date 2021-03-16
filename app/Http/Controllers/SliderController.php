<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Carbon\Carbon;
use App\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
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
            $sliders    = Slider::orderBy('id', 'desc')->get();

            return view('admin.sliders.index', compact('sliders'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $file = $request->file('image');
        $dt = Carbon::now();
        $acak  = $file->getClientOriginalExtension();
        $fileName = 'Slider'.'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
        $request->file('image')->move("img/sliders/", $fileName);
        $image = $fileName;

        Slider::create([
            'image'       => $image
        ]);

        Session::flash('message', 'Gambar berhasil ditambahkan!');
        Session::flash('message_type', 'success');
        return back();
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
        $file = $request->file('image');
        $dt = Carbon::now();
        $acak  = $file->getClientOriginalExtension();
        $fileName = 'Slider'.'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
        $request->file('image')->move("img/sliders/", $fileName);
        $image = $fileName;

        Slider::find($id)->update([
            'image'       => $image
        ]);

        Session::flash('message', 'Gambar berhasil diedit!');
        Session::flash('message_type', 'success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Slider::find($id)->delete();

        Session::flash('message', 'Gambar berhasil dihapus!');
        Session::flash('message_type', 'success');
        return back();
    }
}
