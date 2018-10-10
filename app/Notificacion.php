<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    public function tarea()
    {
    	return $this->belongsTo(Tarea::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
