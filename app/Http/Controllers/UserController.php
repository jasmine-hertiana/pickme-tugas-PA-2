<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use alert;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=\App\User::all();
         return view('staf.user',['user'=>$user]);

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
        $save_user= new \App\User;
        $save_user->name=$request->get('username');
        $save_user->email=$request->get('email');
        $save_user->password=bcrypt('password');
        $save_user->kategori=$request->get('kategori');
        $save_user->notelp=$request->get('notelp');
        $save_user->alamat=$request->get('alamat');
        if ($request->get('roles')=='STAF') {
            # code...
            $save_user->assignRole('staf');
        } else {
            # code...
            $save_user->assignRole('cust');
        }
        $save_user->save();
        return redirect()->route('user.index');
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
        $user = User::findOrFail($id);
        $roles = Role::pluck('name')->all();
        $userRole = $user->roles->pluck('name')->all();
        return view('staf.edit',compact('user','roles','userRole'));
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
        $update_user = User::findOrFail($id);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $update_user->assignRole($request->roles);
        $update_user->kategori=$request->kategori;
        $update_user->save();
        return redirect()->route( 'user.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = \App\User::findOrFail($id);
        $user->delete();
        $user->removeRole('staf','cust');
        return redirect()->route('user.index');
    }
}
