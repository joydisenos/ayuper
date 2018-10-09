<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tarea;
use App\Servicio;

class AdminController extends Controller
{
    public function usuarios()
    {
    	$users = User::all();

    	return view('admin.usuarios',compact('users'));
    }

    public function tareas()
    {
    	$tareas = Tarea::all();

    	return view('admin.tareas',compact('tareas'));
    }

    public function servicios()
    {
    	$servicios = Servicio::where('estatus',1)->get();

    	return view('admin.servicios',compact('servicios'));
    }
}
