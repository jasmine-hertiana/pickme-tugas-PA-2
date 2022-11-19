<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use Alert;
class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $akun=\App\Akun::All();
        $setting=\App\Setting::All();
        return view('staf.setting.setting' ,['akun' => $akun, 'setting'=> $setting]);

    }
    public function simpan(Request $request)
    {
        $kode = $request->kode;
        $akun = $request->akun;
        foreach($akun as $key => $no)
        {
            $input['no_akun'] = $akun[$key]; 
            Setting::where('id_setting',$kode[$key])->update($input);
        }
        Alert::warning('Pesan ','Setting Akun telah dilakukan ');
        return redirect('setting');
    }
   
}
