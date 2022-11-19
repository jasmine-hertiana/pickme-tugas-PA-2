@extends('layouts.layout')
@section('content')
@include('sweetalert::alert')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pilih Sepatu </h1>
</div>
<hr>
<form action="/detail/store" method="POST">
    @csrf
    <div class="content">
        <img src="{{asset('asset/img/Green Butterfly.png')}}" width="300">
        <img src="{{asset('asset/img/Summer Rain.png')}}" width="300">
    </div>
    <div class="form-group col-sm-4">
        <label for="exampleFormControlInput1">No Invoice</label>
        <input type="text" name="no_pilih" value="{{ $formatnya }}" class="form-control" id="exampleFormControlInput1" > 
    </div>
    <div class="form-group col-sm-4">
        <label for="exampleFormControlInput1">Tanggal Transaksi</label>
        <input type="date" min="1" name="tgl" id="addnmbrg" class="form-control" id="exampleFormControlInput1" require >
    </div> 
    <div class="card-header py-3" align="right">
        <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" data-toggle="modal" data-target="#exampleModalScrollable">
            <i class="fas fa-plus fa-sm text-white-50"></i> Wishlist
        </button>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Notelp</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input name="nama_pilih[]" class="form-control" type="hidden" value="{{ Auth::user()->name }}" readonly >{{ Auth::user()->name }}</td>
                        <td><input name="alamat_pilih[]" class="form-control" type="hidden" value="{{ Auth::user()->alamat }}" readonly >{{ Auth::user()->alamat }}</td>
                        <td><input name="notelp_pilih[]" class="form-control" type="hidden" value="{{ Auth::user()->notelp }}" readonly>{{ Auth::user()->notelp }}</td>
                        
                    </tr>
                    </tbody>
                    <thead class="thead-dark">
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Quantity</th>
                            <th>Sub Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php($total = 0)
                    @foreach($temp_pilih as $temp)
                    <tr>
                        <td><input name="kd_brg[]" class="form-control" type="hidden" value="{{$temp->kd_brg}}" readonly >{{$temp->kd_brg}}</td>
                        <td><input name="nama[]" class="form-control" type="hidden" value="{{$temp->nm_brg}}" readonly >{{$temp->nm_brg}}</td>
                        <td><input name="qty_pilih[]" class="form-control" type="hidden" value="{{$temp->qty_pilih}}" readonly>{{$temp->qty_pilih}}</td>
                        <td><input name="sub_total[]" class="form-control" type="hidden" value="{{$temp->sub_total}}" readonly >{{$temp->sub_total}}</td>
                        <td align="center">
                            <a href="/transaksisepatu/hapus/{{$temp->kd_brg}}" onclick="return confirm('Yakin Ingin menghapus data?')" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                            <i class="fas fa-trash-alt fa-sm text-white-50"></i> Hapus</a>
                        </td>
                    </tr>
                    @php($total += $temp->sub_total)
                    @endforeach
                    <tr>
                        <td colspan="4"></td>
                        <td><input name="total" class="form-control" type="hidden" value="{{$total}}">Total {{ number_format($total) }}</a>
                        <td></td>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <input type="submit" class="btn btn-primary btn-send" value="Pesan Sekarang">
        </div>
    </div>
    <img src="{{asset('asset/img/dashboard1.png')}}" width="1100">
</form>
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/semsepatu/store" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Barang</label>
                    <select name="brg" id="kd_brg select2" class="form-control" required width="100%">
                        <option value="">Pilih</option>
                        @foreach ($barang as $product)
                        <option value="{{ $product->kd_brg }}">{{ $product->kd_brg }} - [{{ number_format($product->harga) }}] - {{ $product->nm_brg }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                   <label for="exampleFormControlInput1">QTY</label>
                    <input type="number" min="1" name="qty" id="addnmbrg" class="form-control" id="exampleFormControlInput1" >
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"> Batal</button>
                <input type="submit" class="btn btn-primary btn-send" value="Tambah Barang">
            </div>
        </div>
    </form>
</div>
</div>
@endsection
