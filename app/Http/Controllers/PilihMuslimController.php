<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Barang;
use App\Pilih;
use App\Pilih_tem;
use App\Temp_pilih;
use Alert;
class PilihMuslimController extends Controller
{
    public function index()
    {
        $akun=\App\Akun::All();
        $barang=\App\Barang::All();
        $temp_pilih=\App\Temp_pilih::All();
        //No otomatis untuk transaksi pilih
        $AWAL = 'TRX';
            $bulanRomawi = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
            $noUrutAkhir = \App\Pilih::max('no_pilih');
            $no = 1;
            $formatnya=sprintf("%03s", abs((int)$noUrutAkhir + 1)). '/' . $AWAL .'/' . $bulanRomawi[date('n')] .'/' . date('Y');
            return view('pilih.pilihmuslim' ,['barang' => $barang,'akun' => $akun,'temp_pilih'=>$temp_pilih,'formatnya'=>$formatnya]);
    }
    public function tambahOrder()
    {
        return view('pilihmuslim');
    }
    public function store(Request $request)
    {
        //Validasi jika barang sudah ada paada tabel temporari maka QTY akaan di edit
        if (Pilih_tem::where('kd_brg', $request->brg)->exists()) 
        {
            Alert::warning('Pesan ','barang sudah ada.. QTY akan terupdate ?');
            Pilih_tem::where('kd_brg', $request->brg)->update(['qty_pilih' => $request->qty]);
            return redirect('transaksimuslim');
        }else{
            Pilih_tem::create(['qty_pilih' => $request->qty,'kd_brg' => $request->brg]);
            return redirect('transaksimuslim');
        }
    }
    public function destroy($kd_brg)
    {
        $barang=\App\Pilih_tem::findOrFail($kd_brg);
        $barang->delete();
        Alert::success('Pesan ','Data berhasil dihapus');
        return redirect('transaksimuslim');
    }
}
