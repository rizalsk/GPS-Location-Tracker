@extends('layouts.master')

@section('content')
@php
    $title = "";
    $logo = "no-logo.png";
    if( !is_null($aplikasi) ){
        $title = $aplikasi->nama;
        $logo = is_null($aplikasi->logo) || $aplikasi->logo == "" ? $logo : $aplikasi->logo;
    }
@endphp
<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>{{ $title }}</h2>
        <a href="/pegawai/create" class="btn btn-xs btn-primary pull-right"><i class="fa fa-plus"></i> Tambah Pegawai</a>
        <div class="clearfix"></div>
      </div>

      <div class="x_content">
        <table id="datatable" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>No.</th>
              <th>Foto</th>
              <th>NIK</th>
              <th>Username</th>
              <th>Nama</th>
              <th>Tempat & Tgl Lahir</th>
              <th>Jabatan</th>
              <th>Departemen</th>
              <th>Alamat</th>
              <th>Telepon</th>
              <th>Email</th>
              <th>Level</th>
              <th>Gaji Pokok</th>
              <th>BPJS Kes.</th>
              <th>BPJS JHT</th>
              <th>BPJS TK</th>
              <!-- <th>Uang Mkn</th>
              <th>Uang Transport</th> -->
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; ?>
            @foreach($data as $c)
            <tr>
              <td>{{ $no++ }}</td>
              <td class="text-center"><img class="img-responsive" src="{{ asset('img/pegawai/'.$c->foto ) }}" style="max-width: 50px"></td>
              <td>{{ str_pad( $c->nik, 4, '0', STR_PAD_LEFT) }}</td>
              <td>{{ $c->username }}</td>
              <td>{{ $c->nama }}</td>
              <td>{{ $c->tempat_lahir.' '.$c->tanggal_lahir }}</td>
              <td>{{ $c->jabatan }}</td>
              <td>{{ $c->departemen }}</td>
              <td>{{ $c->alamat }}</td>
              <td>{{ $c->telp }}</td>
              <td>{{ $c->email }}</td>
              <td>{{ $c->level }}</td>
              <td>{{ $c->gaji_pokok }}</td>
              <td>{{ $c->bpjs_kesehatan }}</td>
              <td>{{ $c->bpjs_jht }}</td>
              <td>{{ $c->bpjs_tk }}</td>
              <!-- <td>{{ $c->uang_makan }}</td>
              <td>{{ $c->uang_transport }}</td> -->
              <td>
                <a href="/pegawai/edit/{{ $c->id }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil-square-o"></i> Edit</a>
                <a href="/pegawai/delete/{{ $c->id }}" class="btn btn-xs btn-danger" onclick="return confirm('Apakah anda ingin menghapus data ini?');" data-popup="tooltip" data-original-title="Hapus Data"><i class="fa fa-trash"></i> Hapus</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>
@endsection
 

@push('script')
<script type="text/javascript">

</script>
@endpush