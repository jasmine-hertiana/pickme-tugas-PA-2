@extends('layouts.layout')
@section('content')
<div class="container">
    <div class="row justify-content-left">
        <div class="content">
            <img src="{{asset('asset/img/Green Butterfly.png')}}" width="100">
            <img src="{{asset('asset/img/Summer Rain.png')}}" width="100">
            <img src="{{asset('asset/img/Lily Collection.png')}}" width="100">
        </div>
        <div class="col-md-3">
            <div class="card bg-primary">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card-body bg-light" >
                        <img src="{{asset('asset/img/welcome1.png')}}" width="180"><br>
                        <br><img src="{{asset('asset/img/fb.png')}}" width="20"><a href="https://m.facebook.com/pickme/">  FB PickMe Corp</a></br>
                        <br><img src="{{asset('asset/img/ig.png')}}" width="20"><a href="https://instagram.com/pickme/">  IG PickMe Corp</a></hr>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-left">
        <div class="col-md-15">
            <div class="card bg-primary">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card-body bg-light" >
                        <img src="{{asset('asset/img/maps.png')}}" width="20"><a href="https://maps.app.goo.gl/xAG7aEtZgxyozZHH6">  Bekasi</a></br>
                        <br><img src="{{asset('asset/img/maps.png')}}" width="20"><a href="https://maps.app.goo.gl/xAG7aEtZgxyozZHH6">  Tangerang</a></br>
                        <br><img src="{{asset('asset/img/maps.png')}}" width="20"><a href="https://maps.app.goo.gl/xAG7aEtZgxyozZHH6">  Bandung</a></br>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <img src="{{asset('asset/img/Cloth Collection.png')}}" width="100">
            <img src="{{asset('asset/img/Crochet Kit.png')}}" width="100">
            <img src="{{asset('asset/img/Embroidery Kit.png')}}" width="100">
        </div>
    </div>
    <img src="{{asset('asset/img/dashboard1.png')}}" width="1100">
    @foreach ($barang as $brg)
        <div class="row justify-content-center">
            <div class="col-md-25">
                <div class="card bg-danger">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="card-body bg-light" >
                            --{{ $brg->nm_brg}} 
                            <hr>{{ number_format($brg->stok) }}
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    @endforeach
    <img src="{{asset('asset/img/dashboard1.png')}}" width="1100">
</div>
@endsection
