<?php

// Route::get('/', function () {
//     return view('auth.login'); //halaman home (login)
// });

Route::get('/', function () {
	return redirect()->route('login');
    // return view('auth.login'); //halaman home (login)
});

Route::get('/generate/{password}', function ($password) {
    return bcrypt($password);
});

// Route::post('/goRegister', 'Controller@goRegister'); //masuk halaman register

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home'); 



Route::group(['middleware' => ['auth']], function() 
{
	Route::group(array('prefix' => 'sliders'), function() 
	{
		Route::get('/', 'SliderController@index'); //halaman awal slider
		Route::post('/add', 'SliderController@add'); // proses tambah slider
		Route::post('/update/{id}', 'SliderController@update'); // proses update slider
		Route::get('/delete/{id}', 'SliderController@delete'); // proses delete slider
	});

	Route::group(array('prefix' => 'pegawai'), function() 
	{
		Route::get('/', 'PegawaiController@index'); // halaman utama untuk melihat list pegawai
		Route::get('/create', 'PegawaiController@create'); //halaman admin nambah pegawai
		Route::post('/store', 'PegawaiController@store'); //proses tambah pegawai
		Route::get('/edit/{id}', 'PegawaiController@edit'); //halaman edit
		Route::post('/update/{id}', 'PegawaiController@update'); // proses edit
		Route::get('/delete/{id}', 'PegawaiController@delete'); // // proses hapus
	});


	Route::group(array('prefix' => 'biodata'), function() 
	{
		Route::get('/', 'PegawaiController@biodata'); //halaman awal aplikasi
		Route::post('/update/{id}', 'PegawaiController@updateBiodata'); //proses update aplikasi
	});


	Route::group(array('prefix' => 'aplikasi'), function() 
	{
		Route::get('/', 'AplikasiController@index'); //halaman awal aplikasi
		Route::post('/update/{id}', 'AplikasiController@update'); //proses update aplikasi
	});

	Route::group([ 'prefix' => 'permohonan'], function() 
	{
		Route::get('/', 'PermohonanController@index'); //halaman awal permohonan
		Route::post('/store', 'PermohonanController@store'); //proses tambah permohonan
		Route::get('/status/{status}/{id}', 'PermohonanController@status'); //proses update/edit permohonan
		Route::post('/update/{id}', 'PermohonanController@update'); //proses update/edit permohonan
		Route::get('/delete/{id}', 'PermohonanController@delete'); //proses delete permohonan
	});

	Route::group([ 'prefix' => 'absensi'], function() 
	{
		Route::get('/', 'AbsensiController@index'); //halaman awal absensi
		Route::get('/create', 'AbsensiController@create'); //halaman awal absensi
		Route::post('/store', 'AbsensiController@store'); //proses tambah absensi
		Route::get('/edit/{id}', 'AbsensiController@edit'); //proses update/edit absensi
		Route::post('/update/{id}', 'AbsensiController@update'); //proses update/edit absensi
		Route::get('/delete/{id}', 'AbsensiController@delete'); //proses delete absensi
	});

	Route::group([ 'prefix' => 'report'], function() 
	{
		Route::get('/', 'ReportController@index'); //halaman awal absensi
		Route::get('/create', 'ReportController@create'); //halaman awal absensi
		Route::post('/store', 'ReportController@store'); //proses tambah absensi
		Route::get('/edit/{id}', 'ReportController@edit'); //proses update/edit absensi
		Route::post('/update/{id}', 'ReportController@update'); //proses update/edit absensi
		Route::get('/delete/{id}', 'ReportController@delete'); //proses delete absensi
	});

	Route::group([ 'prefix' => 'kantor'], function() 
	{
		Route::get('/', 'KantorController@index'); //halaman awal tower
		Route::get('/create', 'KantorController@create'); //halaman awal tower
		Route::post('/store', 'KantorController@store'); //proses tambah tower
		Route::get('/edit/{id}', 'KantorController@edit'); //proses update/edit tower
		Route::post('/update/{id}', 'KantorController@update'); //proses update/edit tower
		Route::get('/delete/{id}', 'KantorController@delete'); //proses delete tower
	});

	Route::group([ 'prefix' => 'tower'], function() 
	{
		Route::get('/', 'TowerController@index'); //halaman awal tower
		Route::get('/create', 'TowerController@create'); //halaman awal tower
		Route::post('/store', 'TowerController@store'); //proses tambah tower
		Route::get('/edit/{id}', 'TowerController@edit'); //proses update/edit tower
		Route::post('/update/{id}', 'TowerController@update'); //proses update/edit tower
		Route::get('/delete/{id}', 'TowerController@delete'); //proses delete tower
	});

	Route::group([ 'prefix' => 'gaji'], function() 
	{
		Route::get('/', 'GajiController@index'); //halaman awal gaji
		Route::get('/create', 'GajiController@create'); //halaman awal gaji
		Route::post('/store', 'GajiController@store'); //proses tambah gaji
		Route::get('/edit/{id}', 'GajiController@edit'); //proses update/edit gaji
		Route::post('/update/{id}', 'GajiController@update'); //proses update/edit gaji
		Route::get('/delete/{id}', 'GajiController@delete'); //proses delete gaji

		Route::get('/slip/{id}', 'GajiController@slip'); //slip gaji
	});

	Route::group([ 'prefix' => 'laporan'], function() 
	{
		Route::get('/gaji', 'LaporanController@gaji'); //halaman laporan gaji
		Route::get('/gaji/print', 'LaporanController@printGaji'); //print laporan gaji
	});

});




