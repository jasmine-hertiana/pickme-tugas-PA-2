<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Laporanstok;
use App\Barang;
use App\BarangAwal;
use PDF;
use DB;
class LapstokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Laporanstok::All();
        $barang=\App\Barang::All();
        $barang_awal=\App\BarangAwal::All();
        return view ('laporan.stok',['barang'=>$barang],['barang_awal'=>$barang_awal]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pdf(Request $request)
    {
        $barang = \App\Barang::All();
        $barang_awal=\App\BarangAwal::All();
        $pdf = PDF::loadview('laporan.stok_pdf',['barang'=>$barang,'barang_awal' => $barang_awal])->setPaper('A4','landscape');
        return $pdf->stream();
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
