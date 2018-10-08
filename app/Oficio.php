<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oficio extends Model
{
    public function servicio()
    {
    	return $this->belongsTo(Servicio::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
