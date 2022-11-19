@extends('layouts.layout')
@section('content')
@include('sweetalert::alert')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Setting Akun Transaksi </h1>
</div>
<hr>
<img src="{{asset('asset/img/dashboard1.png')}}" width="1100">
<form action="/setting/simpan" method="POST">
    @csrf
    @foreach ($setting as $stg)
    <div class="row col-sm-10">
        <div class="col-sm">
            <input type="hidden" name="kode[]" value="{{ $stg->id_setting }}">
            <br><label for="exampleFormControlInput1">Transaksi {{ $stg->nama_transaksi}} </label></br>
        </div>
        <div class="col-sm">
            <br><label for="exampleFormControlInput1">{{ $stg->no_akun }}</label></br>
        </div>
        <div class="col-sm">
        <br><select name="akun[]" id="supp select2" class="form-control" required width="100%"></br>
            <option value="">Pilih Akun</option>
            @foreach ($akun as $akn)
                <option value="{{ $akn->no_akun }}">{{ $akn->no_akun }} - {{ $akn->nm_akun }} </option>
            @endforeach
        </select>
            </div>
    </div>
    @endforeach 
    <br><input type="submit" class="btn btn-primary btn-send" value="Update Setting "></br><hr>
</form>
<img src="{{asset('asset/img/dashboard1.png')}}" width="1100">
@endsection