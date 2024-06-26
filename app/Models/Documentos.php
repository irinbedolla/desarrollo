<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
    //use HasFactory;
    protected $table = 'documentacion_persona';
    protected $primaryKey = 'id';
    protected $fillable = ['id_usuario','nivel_estudios', 'titulo', 'especialidad', 'diplomado', 'seminario', 'cursos', 'desarrollo'];

}
