<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ListadoController extends Controller
{
    public function __construct()
    {
    	return $this->middleware('auth');
    }

    public function clientes()
    {
    	$usuarios = User::whereHas('perfil')
                            ->where('estatus', 2)
                            ->get();

    	return view('usuarios.listado',compact('usuarios'));
    }

    public function profesionales()
    {
    	$usuarios = User::whereHas('perfil')
                            ->where('estatus', 1)
                            ->get();

    	return view('usuarios.listado',compact('usuarios'));
    }
}
