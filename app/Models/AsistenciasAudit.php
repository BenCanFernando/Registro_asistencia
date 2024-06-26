<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsistenciasAudit extends Model
{
    use HasFactory;
    public $table= 'asistencias_audit';
    public $fillable =[
    	'Nombre',
        'Apellido',
        'CI',
        'created_at',
        'updated_at'
    ];
}