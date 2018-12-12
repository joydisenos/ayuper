<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tarea;
use App\Servicio;
use App\Oficio;
use App\Perfil;
use App\Presupuesto;
use App\Notificacion;
use App\Referidos;

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

    public function eliminarusuario($id)
    {
        

        $perfil = Perfil::where('user_id',$id)->first();
        if($perfil != null)
        {
            $perfil->delete();
        }

        $oficios = Oficio::where('user_id',$id)->get();

        foreach($oficios as $oficio)
        {
            $oficio->delete();
        }

        $notificacionesUser = Notificacion::where('user_id',$id)->get();

                foreach ($notificacionesUser as $notificacionUser) {
                    $notificacionUser->delete();
                }

        $presupuestosUser = Presupuesto::where('user_id',$id)->get();

                foreach ($presupuestosUser as $presupuestoUser) {
                    $presupuestoUser->delete();
                }

        $tareas = Tarea::where('user_id',$id)->get();

        foreach ($tareas as $tarea) {
    
                $notificaciones = Notificacion::where('tarea_id',$tarea->id)->get();

                foreach ($notificaciones as $notificacion) {
                    $notificacion->delete();
                }

                $presupuestos = Presupuesto::where('tarea_id',$tarea->id)->get();

                foreach ($presupuestos as $presupuesto) {
                    $presupuesto->delete();
                }

            $tarea->delete();
        }

        $referidos = Referidos::where('user_id',$id)->get();

        foreach ($referidos as $ref) {
            $ref->delete();
        }

        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect()->back()->with('status','Registros del usuario eliminado');
    }

    public function tareas()
    {
    	$tareas = Tarea::where('estatus','<',3)
                        ->orderBy('finalizado','asc')
                        ->orderBy('created_at','desc')
                        ->paginate(5);

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

    public function presupuestosnegados()
    {
        $presupuestos = Presupuesto::where('estatus',2)
                                    ->orderBy('created_at','desc')
                                    ->paginate(5);

        return view('admin.presupuestos',compact('presupuestos'));
    }

    public function referidos()
    {
        $users = User::all();

        return view('admin.referidos' , compact('users'));
    }

    public function delreferidos($id)
    {
        $referido = Referidos::findOrFail($id);
        $referido->estatus = 0;
        $referido->save();

        return redirect()->back()->with('status','Referido eliminado');
    }
}
