<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    public function users()
    {
    	return $this->hasMany(Oficio::class);
    }
}
