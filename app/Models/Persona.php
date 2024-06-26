<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //use HasFactory;
    protected $table = 'persona';
    protected $primaryKey = 'id';
    protected $fillable = ['id_usuario','nombre','email','cargo','area_adcripcion','telefono','estudio_maximo','tilulo_universitario','especialidades','diplomados','seminarios','cursos','acciones_desarrollo','observaciones'];

    
}
