<!DOCTYPE html>
<html>
<head>
<title>Laporan Persediaan</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style type="text/css">
table tr td,
table tr th{
    font-size: 10pt;
}
</style>
</head>
<body>
    <table class="table table-bordered" width="100%" align="center">
        <tr align="center">
            <td><h2>Laporan Persediaan Stok Barang<br>Pick Me Corporation</h2>
            <hr>
            </td>
        </tr>
    </table>
    <table class="table table-bordered" align="center">
    <thead>
        <tr>
            <th width="5%">Kode Barang</th>
            <th width="15%">Nama Barang</th>
            <th width="5%">Jenis</th>
            <th width="5%">Stok Awal</th>
        </tr>
    </thead>
    <tbody>
    @foreach($barang_awal as $ba)
        <tr> 
            <td>{{$ba->kd_brgawal}}</td>
            <td>{{$ba->nm_brg}}</td>
            <td>{{$ba->jenis}}</td>
            <td>{{number_format($ba->stok_awal)}}</td>
        </tr>
    @endforeach
    </tbody>
    </table>

    <table class="table table-bordered" align="center">
    <thead>
        <tr>
            <th width="5%">Kode Barang</th>
            <th width="15%">Nama Barang</th>
            <th width="5%">Jenis</th>
            <th width="5%">Stok Akhir</th>
        </tr>
    </thead>
    <tbody>
    @foreach($barang as $brg)
        <tr> 
            <td>{{$brg->kd_brg}}</td>
            <td>{{$brg->nm_brg}}</td>
            <td>{{$brg->jenis}}</td>
            <td>{{number_format($brg->stok)}}</td>
        </tr>
    @endforeach
    </tbody>
    </table>
<div align="right">
    <h6>Tanda Tangan, Staff</h6><br><br><h6>{{ Auth::user()->name }}</h6>
</div>
</body>
</html>
