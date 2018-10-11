<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Perfil;
use App\Servicio;
use App\Oficio;
use App\User;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $userId = Auth::user()->id;
        $perfil = Perfil::where('user_id',$userId)->first();
        $servicios = Servicio::where('estatus',1)->get();

        return view('perfil.perfil',compact('perfil','servicios'));
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

        if(Auth::user()->estatus == 1)
        {
            $validatedData = $request->validate([
            'foto' => 'required|image',
            'tipo' => 'required',
            'dni' => 'required',
            'telefonomovil' => 'required',
            'telefonofijo' => 'required',
            'servicios' => 'required',
            'codigo' => 'required',
            ]);
        }else{
            $validatedData = $request->validate([
            'dni' => 'required',
            'telefonomovil' => 'required',
            'telefonofijo' => 'required',
            'servicios' => 'required',
            'codigo' => 'required',
        ]);
        }


        $userId = Auth::user()->id;
        
        if($request->hasFile('foto'))
        {
            $ruta = '/perfiles/'.$userId;
            $foto = $request->file('foto');
            $nombre = $foto->getClientOriginalName();
            $request->file('foto')->storeAs($ruta, $nombre, 'public');
        }

        $perfil = new Perfil();
        $perfil->user_id = $userId;
        if($request->hasFile('foto'))
        {
            $perfil->foto = $nombre;
        }
        $perfil->dni = $request->dni;
        if(Auth::user()->estatus == 1)
        {
            $perfil->tipo = $request->tipo;
        }
        $perfil->telefonomovil = $request->telefonomovil;
        $perfil->telefonofijo = $request->telefonofijo;
        $perfil->save();

        $user = User::findOrFail($userId);
        $user->codigo = $request->codigo;
        $user->save();

        $servicios = $request->input('servicios');

        foreach ($servicios as $key => $value) {
            $oficio = new Oficio();
            $oficio->user_id = $userId;
            $oficio->servicio_id = $value;
            $oficio->save();
        }

        return redirect()->back()->with('status','Datos Actualizados correctamente!');
    }

    public function password(Request $request)
    {
        $validatedData = $request->validate([
        'password' => 'required|string|min:6|confirmed',
        ]);

        $userId = Auth::user()->id;
        $user = User::findOrFail($userId);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('status','Clave modificada');
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
    public function edit()
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
    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
        'dni' => 'required',
        'telefonomovil' => 'required',
        'telefonofijo' => 'required',
        'servicios' => 'required',
        'codigo' => 'required',
        ]);


        $userId = Auth::user()->id;
        
        if($request->hasFile('foto'))
        {
            $ruta = '/perfiles/'.$userId;
            $foto = $request->file('foto');
            $nombre = $foto->getClientOriginalName();
            $request->file('foto')->storeAs($ruta, $nombre, 'public');
        }

        $perfil = Perfil::findOrFail($id);
        $perfil->user_id = $userId;
        if($request->hasFile('foto'))
        {
            $perfil->foto = $nombre;
        }
        $perfil->dni = $request->dni;
        if(Auth::user()->estatus == 1)
        {
            $perfil->tipo = $request->tipo;
        }
        $perfil->telefonomovil = $request->telefonomovil;
        $perfil->telefonofijo = $request->telefonofijo;
        $perfil->save();

        $user = User::findOrFail($userId);
        $user->codigo = $request->codigo;
        $user->save();

        $actualizarservicios = Oficio::where('user_id',$userId)->get();

        foreach ($actualizarservicios as $actualizarservicio) {
            $oficioDel = Oficio::findOrFail($actualizarservicio->id);
            $oficioDel->delete();
        }

        $servicios = $request->input('servicios');

        foreach ($servicios as $key => $value) {
            $oficio = new Oficio();
            $oficio->user_id = $userId;
            $oficio->servicio_id = $value;
            $oficio->save();
        }

        return redirect()->back()->with('status','Datos Actualizados correctamente!');
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
