@extends('layouts.layout')
@section('content')
@include('sweetalert::alert')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Klaim & Kirim Pesanan Pelanggan </h1>
</div>
<hr> 
<img src="{{asset('asset/img/dashboard1.png')}}" width="1100">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<div class="card-body">

<div class="table-responsive">
<table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
    <thead class="thead-dark">
    <tr>
        <th>No Pesanan</th>
        <th>Tanggal Pemesanan</th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
    @foreach($pilih as $pilih)
    <tr>
        <td width="15%">{{ $pilih->no_pilih }}</td>
        <td>{{ $pilih->tgl_pilih }}</td>
        <td width="30%">
        <a href="{{url('/keranjang-checkout/'.Crypt::encryptString($pilih->no_pilih))}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Klaim</a>
        <a href="{{route('cetak.salesorder_pdf',[Crypt::encryptString($pilih->no_pilih)])}}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
        <i class="fas fa-print fa-sm text-white-50"></i> Cetak Resi</a>
    </tr>
    @endforeach
    </tbody>
 </table>
</div>
</div>
</div>
</form>
<img src="{{asset('asset/img/dashboard1.png')}}" width="1100">
@endsection