<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeerPerGeneral extends Model
{
    //use HasFactory;
    protected $table = 'seer_general';
    protected $primaryKey = 'id';
    protected $fillable = ['fecha', 'fecha_confirmacion','NUE', 'solicitante', 'estado_solicitante', 'mun_solicitante', 'user_id','delegacion','conciliador_id','validado_conciliador'];
}
