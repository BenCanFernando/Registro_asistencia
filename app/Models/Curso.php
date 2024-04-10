<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    public $table= 'cursos';
    public $fillable =[
    	'id',
        'curso',
    	'carrera',
        'facultad'
    ];
    public function usuarios (){
        return $this->belongsToMany(User::class,'user_curso', 'curso_id', 'id');
    }
}
