<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seer extends Model
{
    //use HasFactory;
    protected $table = 'estadisticas';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','solicitudes', 'ratificaciones', 'asesorias', 'expediente_consulta', 'expediente_escaneo', 'expediente_foliar', 
    'cuantificacion', 'exhortos', 'audiencias_celebradas', 'cumplimientos', 'fecha'];

}
