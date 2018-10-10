<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tarea;
use App\Servicio;

class AdminController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }
    
    public function usuarios()
    {
    	$users = User::all();

    	return view('admin.usuarios',compact('users'));
    }

    public function tareas()
    {
    	$tareas = Tarea::paginate(10);

    	return view('admin.tareas',compact('tareas'));
    }

    public function servicios()
    {
    	$servicios = Servicio::where('estatus',1)->get();

    	return view('admin.servicios',compact('servicios'));
    }

    public function actualizarusuario(Request $request)
    {
        $validatedData = $request->validate([
        'nombre' => 'required|min:3',
        'email' => 'required|email|unique:users',
        ]);

        $userId = $request->user_id;
        
        $user = User::findOrFail($userId);
        $user->name = $request->nombre;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('status','Usuario Actualizado');
    }
}
