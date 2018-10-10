<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notificacion;
use App\Tarea;
use App\Mail\PagoVerificado as MailPago;
use App\Mail\DepositoVerificado as MailDeposito;
use App\Mail\VerificacionPago as MailVerificacion;
use App\Mail\PagoNegado as MailNegado;
use Illuminate\Support\Facades\Mail;

class NotificacionController extends Controller
{
	public function __construct()
	{
		return $this->middleware('auth');
	}
	
    public function notificacion($id)
    {
    	$not = Notificacion::findOrFail($id);
    	$not->estatus = 2;
    	$not->save();

    	$tareaId = $not->tarea->id;

    	return redirect( 'tarea' . '/' . $tareaId );
    }

    public function notificaciones()
    {
        $notificaciones = Notificacion::where('estatus','<',3)->where('tipo',2)->get();

        return view('admin.notificaciones',compact('notificaciones'));
    }

    public function estatus( $id, $estatus )
    {
        $notificacion = Notificacion::findOrFail($id);
        $notificacion->estatus = 3;
        $notificacion->save();

        $tarea = Tarea::findOrFail($notificacion->tarea->id);
        $tarea->estatus = $estatus;
        $tarea->save();

        $cliente = $tarea->user->email;
        $profesional = $tarea->presupuesto->user->email;
        $admin = 'info@ayuper.es';

        if($estatus == 1){
            Mail::to($cliente , 'Ayuper.es')
                   ->send(new MailPago($tarea));
            Mail::to($profesional , 'Ayuper.es')
                   ->send(new MailDeposito($tarea));
            Mail::to($admin , 'Ayuper.es')
                   ->send(new MailVerificacion($tarea));

            return redirect()->back()->with('status','Verificación Completada con éxito');
        }else{
            Mail::to($cliente , 'Ayuper.es')
                   ->send(new MailNegado($tarea));
            Mail::to($profesional , 'Ayuper.es')
                   ->send(new MailNegado($tarea));
            Mail::to($admin , 'Ayuper.es')
                   ->send(new MailNegado($tarea));

            return redirect()->back()->with('status','Verificación del pago negado');
        }
    }
}
