<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\MyResetPassword;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','estatus',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MyResetPassword($token));
    }

    public function tareas()
    {
        return $this->hasMany(Tarea::class);
    }

    public function oficios()
    {
        return $this->hasMany(Oficio::class);
    }

    public function perfil()
    {
        return $this->hasOne(Perfil::class);
    }

    public function presupuestos()
    {
        return $this->hasMany(Presupuesto::class);
    }
}
