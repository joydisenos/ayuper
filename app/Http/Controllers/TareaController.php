<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Servicio;
use App\Tarea;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        'descripcion' => 'required|min:3',
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

        return redirect()->back()->with('status','Tarea registrada correctamente, en breves momentos será publicada');
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
        //
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
    public function destroy($id)
    {
        //
    }
}
