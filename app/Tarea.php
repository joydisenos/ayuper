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
}
