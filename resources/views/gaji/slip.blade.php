<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  @php
      $title = "";
      $logo = "no-logo.png";
      if( !is_null($aplikasi) ){
          $title = $aplikasi->nama;
          $logo = is_null($aplikasi->logo) || $aplikasi->logo == "" ? $logo : $aplikasi->logo;
      }
  @endphp

  <link rel="icon" href="{{ asset('img/'.$logo) }}" type="any" sizes="any">
  <title>{{$title}}</title>

  <!-- Bootstrap -->
  <link href="{{ asset('css/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

  <link href="{{ asset('css/admin/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/admin/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
<style type="text/css">
  body{
    font-family: times-new-roman;
  }

  .borderless tr, .borderless tr td, .borderless th {
    border: 0;
  }

  .borderless>tbody>tr>td, .borderless>tbody>tr>th, .borderless>tfoot>tr>td, .borderless>tfoot>tr>th, .borderless>thead>tr>td, .borderless>thead>tr>th {

      border:0;
  }
</style>
</head>

<body>
<div class="row" style="margin-top: 20px">

      <div class="col-md-12">
        
        <table class="table dt-responsive nowrap borderless" cellspacing="0" width="100%" >
          <tr>
            <td width="10%">
              <img src="{{ asset('img/'.$logo) }}" style="width: 100px; height: auto">
            </td>
            <td>
              <h2 style="text-align: center; margin: 0"><b>{{ $title }}</b></h2>
              <p style="text-align: center; font-size: 12px">{{ $aplikasi->alamat }}, Telp : {{ $aplikasi->telp }}  Email : {{ $aplikasi->email }}</p>
            </td>
          </tr>
        </table>

      </div>

      <hr style="height:4px; background-color: black; margin-bottom:-18px">
      <hr style="height:1px; background-color: black; ">
      <div class="x_content">
        <center><h3><b><u>SLIP GAJI {{ strtoupper($namaBulan) }} {{$data->tahun}}</u></b></h3></center>
          
        <div class="col-md-10 col-md-offset-1">
          
          <table class="table dt-responsive nowrap borderless" cellspacing="0" width="100%" >

            <tr>
              <td width="50%">
                <table class="table dt-responsive nowrap borderless" cellspacing="0" width="100%" >

                  <tr>
                    <td width="40%"><strong>Nik</strong></td>
                    <td width="10%"><strong>:</strong></td>
                    <td>{{ $data->pegawai->nik }}</td>
                  </tr>

                  <tr>
                    <td><strong>Nama</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $data->pegawai->nama }}</td>
                  </tr>

                  <tr>
                    <td><strong>Jml Hari Kerja</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $data->hari_kerja }}</td>
                  </tr>

                  <tr>
                    <td><strong>Jml Hari Izin</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $data->hari_izin }}</td>
                  </tr>

                  <tr>
                    <td><strong>Jml Hari Cuti</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $data->hari_cuti }}</td>
                  </tr>

                  <tr>
                    <td><strong>Jml Hari Cuti</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $data->hari_cuti }}</td>
                  </tr>

                </table>
              </td>

              <td width="50%">
                <table class="table dt-responsive nowrap borderless" cellspacing="0" width="100%" >

                  <tr>
                    <td width="40%"><strong>Gaji Pokok</strong></td>
                    <td width="10%"><strong>:</strong></td>
                    <td>Rp.{{ number_format($data->gaji_pokok) }}</td>
                  </tr>

                  <tr>
                    <td><strong>Bpjs Kesehatan</strong></td>
                    <td><strong>:</strong></td>
                    <td>Rp.{{ number_format($data->bpjs_kesehatan) }}</td>
                  </tr>

                  <tr>
                    <td><strong>Bpjs Tenaga Kerja</strong></td>
                    <td><strong>:</strong></td>
                    <td>Rp.{{ number_format($data->bpjs_tk) }}</td>
                  </tr>

                  <tr>
                    <td><strong>Bpjs Jaminan Hari Tua</strong></td>
                    <td><strong>:</strong></td>
                    <td>Rp.{{ number_format($data->bpjs_jht) }}</td>
                  </tr>

                  <tr>
                    <td><strong>Potongan Lainnya</strong></td>
                    <td><strong>:</strong></td>
                    <td>Rp.{{ number_format($data->potongan_lain) }}</td>
                  </tr>

                  <tr>
                    <td><strong>Bonus</strong></td>
                    <td><strong>:</strong></td>
                    <td>Rp.{{ number_format($data->bonus) }}</td>
                  </tr>

                </table>
              </td>


            </tr>
            <tr>
              <td align="right">
                <h3><strong>Take Home Pay :</strong></h3>
              </td>
              <td>
                <h3><strong>Rp.{{ number_format($data->total,0) }}</strong></h3>
              </td>
            </tr>

          </table>

          

        </div>


        <hr style="height:1px; background-color: black;">

        <table class="table dt-responsive nowrap borderless" cellspacing="0" width="100%" >
          <tr>
            <td width="70%">
              Demikian data gaji ini disampaikan sebagai bukti rincian gaji pegawai yang sebenarnya.
            </td>
            <td>
              <div>Denpasar, {{ date('d F Y') }}</div>
              <div>Mengetahui,</div>
              <div>
                HRD<br><br><br><br>

                <u>................................................................</u><br>
                NIK
              </div>
            </td>
          </tr>
        </table>

      </div>

      </div>

    </div>

</body>
</html>
