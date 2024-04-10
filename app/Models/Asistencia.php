<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    public $table= 'asistencias';
    public $fillable =[
    	'idasistencia',
        'fecha_asist',
        'usuarios_idusuario',
        'asignaturas_idasignatura'
    ];
    public function usuario (){
        return $this->belongsToMany(User::class,'usuarios_idusuario');
    }
    public function asignatura (){
        return $this->belongsToMany(User::class,'asignaturas_idasignatura');
    }
}
