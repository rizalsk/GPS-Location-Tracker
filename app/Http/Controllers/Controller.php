<?php

namespace App\Http\Controllers;

use Session;
use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
// use RealRashid\SweetAlert\Facades\Alert;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function goRegister(Request $request)
    {
        $this->validate($request, [
            'nama'  => 'required|string|max:30|min:3|unique:users',
            'email'  => 'required|string|unique:users',
            'username'  => 'required|string|max:10|min:3|unique:users',
            'password'  => 'required|max:10|min:3',
        ]);

        // $pass = $request->input('password');
        // $konf = $request->input('password_confirmation');
        // dd($pass, $konf);

        // if ($pass != $konf) {
        //     Session::flash('message', 'Konfirmasi password tidak sama');
        //     Session::flash('message_type', 'error');
        //     return back();
        // }else{

            User::create([
                'nama'      => $request->input('nama'),
                'email'     => $request->input('email'),
                'username'  => $request->input('username'),
                'password'  => bcrypt(($request->input('password'))),
                'level'     => 'calon',
            ]);

            Session::flash('message', 'Sukses! Registrasi Berhasil.');
            Session::flash('message_type', 'success');
            return redirect('/');
        // }
    }
}
