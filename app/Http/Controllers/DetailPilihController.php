<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\DetailPilih;
use App\Pilih;
use Alert;
class DetailPilihController extends Controller
{
    public function store(Request $request)
    {
        //Simpan ke table pilih
        $tambah_pilih=new \App\Pilih;
        $tambah_pilih->no_pilih = $request->no_pilih;
        $tambah_pilih->tgl_pilih = $request->tgl;
        $tambah_pilih->total = $request->total;
        $tambah_pilih->save();
        //SIMPAN DATA KE TABEL DETAIL
        $kd_brg = $request->kd_brg;
        $qty= $request->qty_pilih;
        $sub_total= $request->sub_total;
        $nama_pilih= $request->nama_pilih;
        $notelp_pilih= $request->notelp_pilih;
        $alamat_pilih= $request->alamat_pilih;
        foreach($kd_brg as $key => $no)
        {
            $input['no_pilih'] = $request->no_pilih;
            $input['kd_brg'] = $kd_brg[$key];
            $input['qty_pilih'] = $qty[$key];
            $input['subtotal'] = $sub_total[$key];
            $input['nama_pilih'] = $nama_pilih[$key];
            $input['notelp_pilih'] = $notelp_pilih[$key];
            $input['alamat_pilih'] = $alamat_pilih[$key];
            DetailPilih::insert($input); 
        }
        Alert::success('Pesan ','Barang akan Segera Dikirimkan');
        return redirect('/home');
    }


}
