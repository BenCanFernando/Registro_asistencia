<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lastname',
        'CI',
        'email',
        'password',
        'role',
        'state'
    ];
    
    public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class, 'asignaturas', 'usuarios_idusuario', 'asignaturas_idasignatura');
    }

    public function asistencias()
    {
        return $this->belongsToMany(Asistencia::class, 'asistencias', 'usuarios_idusuario', 'asignaturas_idasignatura');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function setPasswordAttribute($password) {

        $this->attributes['password'] = bcrypt($password);
    }
}
