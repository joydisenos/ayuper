<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tarea;

class SiteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tareas = Tarea::where('estatus',0)
                ->where('codigo', Auth::user()->codigo)
                ->orderBy('finalizado','asc')
                ->orderBy('created_at','desc')
                ->paginate(5);

        return view('home',compact('tareas'));
    }
}
