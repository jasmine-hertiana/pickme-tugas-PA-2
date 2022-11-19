<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use App\BarangAwal;
class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang=\App\Barang::All();
        return view('staf.barang.barang',['barang'=>$barang]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staf.barang.input');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tambah_barang=new \App\Barang;
        $tambah_barang->kd_brg = $request->addkdbrg;
        $tambah_barang->nm_brg = $request->addnmbrg;
        $tambah_barang->harga = $request->addharga;
        $tambah_barang->jenis = $request->jenis;
        $tambah_barang->stok = $request->addstok;
        $tambah_barang->save();

        $tambah_barangawal=new \App\BarangAwal;
        $tambah_barangawal->kd_brgawal = $request->addkdbrg;
        $tambah_barangawal->nm_brg = $request->addnmbrg;
        $tambah_barangawal->harga = $request->addharga;
        $tambah_barangawal->jenis = $request->jenis;
        $tambah_barangawal->stok_awal = $request->addstok;
        $tambah_barangawal->save();
        Alert::success('Pesan ','Data berhasil disimpan');
        return redirect('/barang');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang_edit=\App\Barang::findOrFail($id);
        return view('staf.barang.edit',['barang'=>$barang_edit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $barang=\App\Barang::findOrFail($id);
        $barang->kd_brg=$request->get('addkdbrg');
        $barang->nm_brg=$request->get('addnmbrg');
        $barang->harga=$request->get('addharga');
        $barang->jenis=$request->get('jenis');
        $barang->stok=$request->get('addstok');
        $barang->save();

        $barangawal=\App\BarangAwal::findOrFail($id);
        $barangawal->kd_brgawal=$request->get('addkdbrg');
        $barangawal->nm_brg=$request->get('addnmbrg');
        $barangawal->harga=$request->get('addharga');
        $barangawal->jenis=$request->get('jenis');
        $barangawal->stok_awal=$request->get('addstok');
        $barangawal->save();
        return redirect()->route('barang.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang=\App\Barang::findOrFail($id);
        $barang->delete();
        $barangawal=\App\BarangAwal::findOrFail($id);
        $barangawal->delete();
        Alert::success('Pesan ','Data berhasil dihapus');
        return redirect()->route('barang.index');
    }
}
