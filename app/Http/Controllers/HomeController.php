<?php

namespace App\Http\Controllers;

use App\Slider;
use App\Kejuruan;
use App\Informasi;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sliders    = Slider::orderBy('id', 'desc')->limit(5)->get();

        return view('home', compact('sliders'));
    }

    public function contactus()
    {
        return view('contact');
    }
}
