<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Tareacercana as MailTarea;
use App\Servicio;
use App\Tarea;
use App\User;
use App\Presupuesto;
use App\Notificacion;

class TareaController extends Controller
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
        $tareas = Tarea::where('user_id',$userId)
                        ->where('estatus','<',3)
                        ->orderBy('finalizado','asc')
                        ->orderBy('created_at','desc')
                        ->paginate(5);
        $notificaciones = Notificacion::where('user_id',$userId)
                        ->orderBy('created_at','desc')
                        ->paginate(5);

        return view('tareas.mistareas',compact('tareas','notificaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $servicios = Servicio::where('estatus',1)->get();
        
        return view('tareas.nuevatarea',compact('servicios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'lista' => 'required',
        'nombre' => 'required|min:3|max:255',
        'descripcion' => 'required|min:10|max:100',
        'fechainicio' => 'required',
        'fechafinal' => 'required',
        'frecuencia' => 'required',
        'horas' => 'required',
        'codigo' => 'required|numeric',
        ]);

        $userId = Auth::user()->id;

        $tarea = new Tarea();
        $tarea->servicio_id = $request->lista;
        $tarea->user_id = $userId;
        $tarea->nombre = $request->nombre;
        $tarea->descripcion = $request->descripcion;
        $tarea->inicio = $request->fechainicio;
        $tarea->final = $request->fechafinal;
        $tarea->frecuencia = $request->frecuencia;
        $tarea->horas = $request->horas;
        $tarea->codigo = $request->codigo;
        $tarea->save();

        $users = User::where( 'codigo' , $request->codigo )
                        ->where('estatus' , 1)
                        ->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new MailTarea());
        }

        return redirect('home')->with('status','Tarea registrada correctamente, en breves momentos será publicada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tarea = Tarea::findOrFail($id);
        $presupuestos = Presupuesto::where('tarea_id',$id)
                        ->where('estatus',1)
                        ->orderBy('created_at','desc')
                        ->paginate(4);

        return view('tareas.tarea',compact('tarea','presupuestos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tarea = Tarea::findOrFail($id);
        $servicios = Servicio::where('estatus',1)->get();

        return view('tareas.modificartarea',compact('tarea','servicios'));
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
        $validatedData = $request->validate([
        'lista' => 'required',
        'nombre' => 'required|min:3|max:255',
        'descripcion' => 'required|min:10|max:100',
        'fechainicio' => 'required',
        'fechafinal' => 'required',
        'frecuencia' => 'required',
        'horas' => 'required',
        'codigo' => 'required|numeric',
        ]);

        $tarea = Tarea::findOrFail($id);
        $tarea->servicio_id = $request->lista;
        $tarea->nombre = $request->nombre;
        $tarea->descripcion = $request->descripcion;
        $tarea->inicio = $request->fechainicio;
        $tarea->final = $request->fechafinal;
        $tarea->frecuencia = $request->frecuencia;
        $tarea->horas = $request->horas;
        $tarea->codigo = $request->codigo;
        $tarea->save();

        return redirect()->back()->with('status','Tarea modificada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->estatus = 3;
        $tarea->save();

        return redirect()->back()->with('status','Tarea eliminada');
    }
}
