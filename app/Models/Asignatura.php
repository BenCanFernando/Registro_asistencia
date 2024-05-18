<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    use HasFactory;
    public $table= 'asignaturas';
    public $fillable =[
    	'idasignatura',
        'codigo',
    	'materia',
        'usuarios_idusuario',
        'cursos_idcurso'
    ];

    public function cursos()
    {
        return $this->belongsTo(Curso::class, 'cursos_idcurso');
    }

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'asistencias', 'idasignatura', 'usuarios_idusuario');
    }
}