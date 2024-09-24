<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeerConciliadores extends Model
{
    //use HasFactory;
    protected $table = 'estadisticas_conciliadores';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','solicitues_atendidas', 'audiencia_programada', 'audiencia_celebradas', 'convenios_conciliatorios', 'ratificaciones_convenio', 
    'contancias_no_conciliacion', 'cuantificaciones', 'asesorias', 'integracion_expediente', 'colectivas', 'fecha', 'delegacion'];

}
