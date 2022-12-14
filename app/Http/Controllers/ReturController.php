<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Retur;
use App\DetailRetur;
use App\Pembelian;
use App\Supplier;
use DB;
use Alert;
class ReturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembelian=\App\Pembelian::All();
        return view('retur.retur',['pembelian'=>$pembelian]);
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
        if (Retur::where('no_retur', $request->no_retur)->exists()) {
            Alert::warning('Pesan ','Retur sudah dilakukan ');
            return redirect('retur');
        }else{
            //SIMPAN DATA KE TABEL DETAIL RETUR
            $kdbrg = $request->kd_brg;
            $qtyretur = $request->jml_retur;
            $harga = $request->harga;
            $total=0;
            foreach($kdbrg as $key => $no)
            {
                $input['no_retur'] = $request->no_retur;
                $input['kd_brg'] = $kdbrg[$key];
                $input['qty_retur'] = $qtyretur[$key];
                $input['sub_retur'] = $harga[$key]*$qtyretur[$key];
                DetailRetur::insert($input);
                $total=$harga[$key]*$qtyretur[$key];
            }
            //Simpan ke table retur
            $tambah_pembelian=new \App\Retur;
            $tambah_pembelian->no_retur = $request->no_retur;
            $tambah_pembelian->tgl_retur = $request->tgl;
            $tambah_pembelian->total_retur = $total;
            $tambah_pembelian->save();
            //SIMPAN ke table jurnal bagian debet
            $tambah_jurnaldebet=new \App\Jurnal;
            $tambah_jurnaldebet->no_jurnal = $request->no_jurnal;
            $tambah_jurnaldebet->keterangan = 'Kas';
            $tambah_jurnaldebet->tgl_jurnal = $request->tgl;
            $tambah_jurnaldebet->no_akun = $request->kas;
            $tambah_jurnaldebet->debet = $total;
            $tambah_jurnaldebet->kredit = '0';
            $tambah_jurnaldebet->save();
            //SIMPAN ke table jurnal bagian kredit
            $tambah_jurnalkredit=new \App\Jurnal;
            $tambah_jurnalkredit->no_jurnal = $request->no_jurnal;
            $tambah_jurnalkredit->keterangan = 'Retur Pembelian';
            $tambah_jurnalkredit->tgl_jurnal = $request->tgl;
            $tambah_jurnalkredit->no_akun = $request->retur;
            $tambah_jurnalkredit->debet ='0';
            $tambah_jurnalkredit->kredit = $total;
            $tambah_jurnalkredit->save();
            Alert::success('Pesan ','Data berhasil disimpan');
            return redirect('/retur');
        }

           
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
        $AWAL = 'RTR';
        $bulanRomawi = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $noUrutAkhir = \App\Retur::max('no_retur');
        $no = 1; 
        $format=sprintf("%03s", abs((int)$noUrutAkhir + 1)). '/' . $AWAL .'/'. $bulanRomawi[date('n')] .'/' . date('Y');
        //No otomatis untuk jurnal
        $AWALJurnal = 'JRU';
        $bulanRomawij = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $noUrutAkhirj = \App\Jurnal::max('no_jurnal');
        $noj = 1;
        $formatj=sprintf("%03s", abs((int)$noUrutAkhirj + 1)). '/' . $AWALJurnal .'/' . $bulanRomawij[date('n')] .'/' . date('Y'); 
        $decrypted = Crypt::decryptString($id);
        $detail = DB::table('tampil_pembelian')->where('no_beli',$decrypted)->get();
        $pemesanan = DB::table('pemesanan')->where('no_pesan',$decrypted)->get();
        $akunkas = DB::table('setting')->where('nama_transaksi','Kas')->get();
        $akunretur = DB::table('setting')->where('nama_transaksi','Retur')->get();
        return view('retur.beli',['beli'=>$detail,'format'=>$format,'no_pesan'=>$decrypted,'pemesanan'=>$pemesanan,'formatj'=>$formatj,'kas'=>$akunkas,'retur'=>$akunretur]);
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
    public function destroy($no_beli)
    {
        $pembelian=\App\Retur::findOrFail($no_beli);
        $pembelian->delete();
        Alert::success('Pesan ','Data berhasil dihapus');
        return redirect('retur');
    }
    
    public function pdf($id){
        $decrypted = Crypt::decryptString($id);
        $retur_beli = DB::table('retur_beli')->where('no_retur',$decrypted)->get();
        $pdf = PDF::loadView('laporan.returpdf',['retur_beli'=>$retur_beli,'beli'=>$pembelian,'suppplier'=>$supplier,'noorder'=>$decrypted]);
        return $pdf->stream();
    }
}
