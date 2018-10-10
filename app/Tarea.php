<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function servicio()
    {
    	return $this->belongsTo(Servicio::class);
    }

    public function presupuestos()
    {
    	return $this->hasMany(Presupuesto::class);
    }

    public function presupuesto()
    {
        return $this->belongsTo(Presupuesto::class);
    }

    public function notificaciones()
    {
        return $this->hasMany(Notificacion::class);
    }
}
