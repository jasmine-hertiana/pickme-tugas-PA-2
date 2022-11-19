<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use App\DetailKeranjang;
use App\Keranjang;
use DB;
use Alert;
use PDF;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pilih=\App\Pilih::All();
        //perintah SQL untuk menghilangkan data keranjang ketika sudah di checkout
        $pilih = DB::select('SELECT * FROM pilih where not exists (select * from keranjang where pilih.no_pilih=keranjang.no_pilih)');
        return view('keranjang.keranjang',['pilih'=>$pilih]);

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
        if (Keranjang::where('no_pilih', $request->no_pilih)->exists()) {
            Alert::warning('Pesan ','Barang akan sampai ke Pelanggan');            
            return redirect('keranjang');
        }else{
            //Simpan ke table keranjang
            $tambah_keranjang=new \App\Keranjang;
            $tambah_keranjang->no_checkout = $request->no_invoice;
            $tambah_keranjang->tgl_checkout = $request->tgl;
            $tambah_keranjang->no_invoice = $request->no_invoice;
            $tambah_keranjang->total_checkout = $request->total;
            $tambah_keranjang->no_pilih = $request->no_pilih;
            $tambah_keranjang->save();
           //SIMPAN DATA KE TABEL DETAIL keranjang
            $kdbrg = $request->kd_brg;
            $qtycheckout = $request->qty_checkout;
            $subcheckout = $request->sub_checkout;
            foreach($kdbrg as $key => $no)
            {
                $input['no_checkout'] = $request->no_invoice;
                $input['kd_brg'] = $kdbrg[$key];
                $input['qty_checkout'] = $qtycheckout[$key];
                $input['sub_checkout'] = $subcheckout[$key];
                DetailKeranjang::insert($input);
            }
            //SIMPAN ke table jurnal bagian debet
            $tambah_jurnaldebet=new \App\Jurnal;
            $tambah_jurnaldebet->no_jurnal = $request->no_jurnal;
            $tambah_jurnaldebet->keterangan = 'Kas ';
            $tambah_jurnaldebet->tgl_jurnal = $request->tgl;
            $tambah_jurnaldebet->no_akun = $request->akun;
            $tambah_jurnaldebet->debet = $request->total;
            $tambah_jurnaldebet->kredit = '0';
            $tambah_jurnaldebet->save();

            //SIMPAN ke table jurnal bagian kredit
            $tambah_jurnalkredit=new \App\Jurnal;
            $tambah_jurnalkredit->no_jurnal = $request->no_jurnal;
            $tambah_jurnalkredit->keterangan = 'Penjualan Tunai';
            $tambah_jurnalkredit->tgl_jurnal = $request->tgl;
            $tambah_jurnalkredit->no_akun = $request->penjualan_tunai;
            $tambah_jurnalkredit->debet ='0';
            $tambah_jurnalkredit->kredit = $request->total;
            $tambah_jurnalkredit->save();
            Alert::success('Pesan ','Data Pembayaran telah ditambah');
            return redirect('/keranjang');
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
        $AWAL = 'INV';
        $bulanRomawi = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $noUrutAkhir = \App\Keranjang::max('no_checkout');
        $no = 1; 
        $format=sprintf("%03s", abs((int)$noUrutAkhir + 1)). '/' . $AWAL .'/' . $bulanRomawi[date('n')] .'/' . date('Y');
        $AWALJurnal = 'JRU';
        $bulanRomawij = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $noUrutAkhirj = \App\Jurnal::max('no_jurnal');
        $noj = 1;
        $formatj=sprintf("%03s", abs((int)$noUrutAkhirj + 1)). '/' . $AWALJurnal.'/' . $bulanRomawij[date('n')] .'/' . date('Y');
 
        $decrypted = Crypt::decryptString($id);
        $detail = DB::table('tampil_pilih')->where('no_pilih',$decrypted)->get();
        $pilih = DB::table('pilih')->where('no_pilih',$decrypted)->get();
        $akunkas = DB::table('setting')->where('nama_transaksi','Kas')->get();
        $akunpenjualan = DB::table('setting')->where('nama_transaksi','Penjualan Tunai')->get();
        return view('keranjang.checkout',['detail'=>$detail,'format'=>$format,'no_pilih'=>$decrypted,'pilih'=>$pilih,'formatj'=>$formatj,'kas'=>$akunkas,'penjualan_tunai'=>$akunpenjualan]);

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
    public function destroy($kd_brg)
    {
        $barang=\App\Keranjang::findOrFail($kd_brg);
        $barang->delete();
        Alert::success('Pesan ','Data berhasil dihapus');
        return redirect('keranjang');
    }
    public function pdf($id){
        $decrypted = Crypt::decryptString($id);
        $detail = DB::table('tampil_pilih')->where('no_pilih',$decrypted)->get();
        $pilih = DB::table('pilih')->where('no_pilih',$decrypted)->get();
        $id = DB::table('detail_pilih')->where('no_pilih',$decrypted)->get();
        $pdf = PDF::loadView('laporan.invoice',['id'=>$id,'detail'=>$detail,'order'=>$pilih,'noorder'=>$decrypted]);
        return $pdf->stream();
    }
       
}
 