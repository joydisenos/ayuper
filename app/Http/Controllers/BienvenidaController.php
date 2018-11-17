<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Referidos;
use App\Mail\Bienvenido as BienvenidoMail;
use App\Mail\Nuevousuario as NuevoMail;

class BienvenidaController extends Controller
{

	public function __construct()
	{
		return $this->middleware('auth');
	}

    public function bienvenida()
    {
      $referido = Auth::user()->referido;

      if ($referido != null) {
        $ref = new Referidos();
        $ref->referido_id = Auth::user()->referido;
        $ref->user_id = Auth::user()->id;
        $ref->save();
      }

    	$mail = Auth::user()->email;
    	Mail::to($mail , 'Ayuper.es')
                   ->send(new BienvenidoMail());

        Mail::to('hola@ayuper.es' , 'Ayuper.es')
                   ->send(new NuevoMail());
                   
        return redirect('perfil');
    }
}
