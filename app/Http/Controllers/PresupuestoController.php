<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Presupuesto;
use App\Tarea;
use App\Notificacion;
use Illuminate\Support\Facades\Mail;
use App\Mail\Presupuesto as PresupuestoMail;
use App\Mail\Adjudicado as AdjudicadoMail;
use App\Mail\Presupuestoaprobado as AprobadoMail;
use App\Mail\NegarPresupuesto as PresupuestoNegadoMail;

class PresupuestoController extends Controller
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
        //
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

    public function aceptar($presupuesto , $tarea)
    {
        $tarea = Tarea::findOrFail($tarea);
        $tarea->presupuesto_id = $presupuesto;
        $tarea->finalizado = 1;
        $tarea->save();

        $presupuestoAceptado = Presupuesto::findOrFail($presupuesto);
        $mail = $presupuestoAceptado->user->email;

        $not = new Notificacion();
        $not->user_id = $presupuestoAceptado->user->id;
        $not->tarea_id = $tarea->id;
        $not->detalles = 'El Cliente ha aprobado tu presupuesto';
        $not->tipo = 2;
        $not->save();

        Mail::to($mail , 'Ayuper.es')
                   ->send(new AdjudicadoMail());

        Mail::to('hola@ayuper.es' , 'Ayuper.es')
                   ->send(new AprobadoMail());

        return redirect()->back()->with('status','Felicidades aceptaste con éxito la propuesta!');
    }

    public function negar($presupuesto)
    {
        $presupuesto = Presupuesto::findOrFail($presupuesto);
        $presupuesto->estatus = 2;
        $presupuesto->save();

        Mail::to($presupuesto->user->email , 'Ayuper.es')
                   ->send(new PresupuestoNegadoMail($presupuesto));

        return redirect()->back()->with('status','Presupuesto Negado');
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
        'detalles' => 'required|min:10|max:100',
        'precio' => 'required|numeric',
        ]);

        $presupuesto = new Presupuesto();
        $presupuesto->user_id = $request->user_id;
        $presupuesto->tarea_id = $request->tarea_id;
        $presupuesto->detalles = $request->detalles;
        $presupuesto->precio = $request->precio;
        $presupuesto->save();

        $tarea = Tarea::findOrFail($request->tarea_id);
        $mail = $tarea->user->email;

        $not = new Notificacion();
        $not->user_id = $tarea->user->id;
        $not->tarea_id = $request->tarea_id;
        $not->detalles = 'Ha recibido un presupuesto nuevo';
        $not->tipo = 1;
        $not->save();

        Mail::to($mail , 'Ayuper.es')
                   ->send(new PresupuestoMail());

        return redirect()->back()->with('status','Presupuesto enviado con éxito');
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
