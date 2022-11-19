@extends('layouts.layout')
@section('content')
@include('sweetalert::alert')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Klaim Pesanan Pelanggan </h1>
</div>
<hr>
<img src="{{asset('asset/img/dashboard1.png')}}" width="1100"><hr>
<form action="/keranjang/store" method="POST">
    @csrf
 
        <div class="form-group col-sm-4">
            <label for="exampleFormControlInput1">No Penjualan</label> 
            @foreach($kas as $ks)
            <input type="hidden" name="akun" value="{{ $ks->no_akun }}" class="form-control" id="exampleFormControlInput1" > 
            @endforeach
            @foreach($penjualan_tunai as $pt)
            <input type="hidden" name="penjualan_tunai" value="{{ $pt->no_akun }}" class="form-control" id="exampleFormControlInput1" > 
            @endforeach
            <input type="hidden" name="no_jurnal" value="{{ $formatj }}" class="form-control" id="exampleFormControlInput1" >
            <input type="text" name="no_invoice" value="{{ $format }}" class="form-control" id="exampleFormControlInput1" >
        </div>
        @foreach($pilih as $pl)
        <div class="form-group col-sm-4">
            <label for="exampleFormControlInput1">No Pemesanan</label> 
            <input type="text" name="no_pilih" value="{{ $pl->no_pilih }}" class="form-control" id="exampleFormControlInput1" >
        </div>
 
        <div class="form-group col-sm-4">
            <label for="exampleFormControlInput1">Tanggal Pemesanan</label>
            <input type="text" min="1" name="tgl" value="{{ $pl->tgl_pilih }}" id="addnmbrg" class="form-control" id="exampleFormControlInput1" require > 
        </div>
        @endforeach 
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<div class="card-body">

<div class="table-responsive">
<table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
    <thead class="thead-dark">
    <tr>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Quantity</th>
        <th>Sub Total</th>
    </tr>
    </thead>
    <tbody>
    @php($total = 0)
    @foreach($detail as $temp)
    <tr>
        <td><input name="no_checkout[]" class="form-control" type="hidden" value="{{$temp->no_pilih}}" readonly><input name="kd_brg[]" class="form-control" type="hidden" value="{{$temp->kd_brg}}" readonly>{{$temp->kd_brg}}</td>
        <td>{{$temp->nm_brg}}</td>
        <td><input name="qty_checkout[]" class="form-control" type="hidden" value="{{$temp->qty_pilih}}" readonly>{{$temp->qty_pilih}}</td>
        <td><input name="sub_checkout[]" class="form-control" type="hidden" value="{{$temp->sub_total}}" readonly>{{$temp->sub_total}}</td>
    </tr>
    @php($total += $temp->sub_total)
    @endforeach
        <tr>
            <td colspan="3"></td>
            <td><input name="total" class="form-control" type="hidden" value="{{$total}}">Total {{number_format($total)}}</a>
            <td ></td></td>
        </tr>
    </tbody>
</table>
</div>
    <input type="submit" class="btn btn-primary btn-send" value=" Kirim Barang ">
</div>
</div>
</form>
<img src="{{asset('asset/img/dashboard1.png')}}" width="1100">
@endsection
