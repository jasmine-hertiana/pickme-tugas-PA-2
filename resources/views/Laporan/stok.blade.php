@extends('layouts.layout')
@section('content')
<img src="{{asset('asset/img/dashboard1.png')}}" width="1100">
<br></br>
    <a href="{{route('cetak.stok_pdf')}}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
    <i class="fas fa-print fa-sm text-white-50"></i> Cetak Laporan Stok</a><hr>
<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-5">
            <div class="card bg_secondary">
                <div class="card-header text-center">Stok Awal</div>
                    <div class="card-body bg-secondary">
                        <div class="card-body bg-light" >
                            @foreach ($barang_awal as $brga)
                                {{ $brga->kd_brgawal}} -->
                                {{ $brga->nm_brg}} -->
                                {{ number_format($brga->stok_awal) }}<hr>
                            @endforeach
                        </div>    
                    </div>
                </div>
            </div>
            <div class="col-md-5">
            <div class="card bg_secondary">
                <div class="card-header text-center">Stok Akhir</div>
                    <div class="card-body bg-secondary">
                        <div class="card-body bg-light" >
                            @foreach ($barang as $brg)
                                {{ $brg->nm_brg}} -->
                                {{ number_format($brg->stok) }}<hr>
                            @endforeach
                        </div>    
                    </div>
                </div>
            </div>
        </div>
</div>
<img src="{{asset('asset/img/dashboard1.png')}}" width="1100">
@endsection
