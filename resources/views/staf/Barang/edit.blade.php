@extends('layouts.layout')
@section('content')
@include('sweetalert::alert')
<form action="{{route('barang.update', [$barang->kd_brg])}}" method="POST">
    <img src="{{asset('asset/img/dashboard1.png')}}" width="1100"><hr>
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <fieldset>
        <legend>Ubah Data Barang</legend>
        <div class="form-group row">
            <div class="col-md-5">
                <label for="addkdbrg">Kode Barang</label>
                <input class="form-control" type="text" name="addkdbrg" value="{{$barang->kd_brg}}" readonly>
            </div>
            <div class="col-md-5">
                <label for="addnmbrg">Nama Barang</label>
                <input id="addnmbrg" type="text" name="addnmbrg" class="form-control" value="{{$barang->nm_brg}}">
            </div>
            <div class="col-md-5">
                <label for="Harga">Harga</label>
                <input id="addharga" type="text" name="addharga" class="form-control" value="{{$barang->harga}}">
            </div>
            <div class="col-md-5">
                    <label class="col-lg-20 control-label">Jenis</label>
                    <div class="col-md-5">
                        <select id="jenis" name="jenis" class="form-control" required>
                            <option value="">--{{$barang->jenis}}--</option>
                            <option value="Sepatu">Sepatu</option>
                            <option value="Fashion Muslim">Fashion Muslim</option>
                            <option value="Handicraft">Handicraft</option>
                        </select>
                    </div>
                </div>
            <div class="col-md-5">
                <label for="Stok">Stok</label>
                <input id="addstok" type="text" name="addstok" class="form-control" value="{{$barang->stok}}">
            </div>
    </fieldset>
    <div class="col-md-10">
        <input type="submit" class="btn btn-success btn-send" value="Update">
        <a href="{{ route('barang.index') }}"><input type="Button" class="btn btn-primary btn-send" value="Kembali"></a>
    </div>
    <hr>
    <img src="{{asset('asset/img/dashboard1.png')}}" width="1100">
</form>
@endsection