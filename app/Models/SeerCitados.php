<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeerCitados extends Model
{
    //use HasFactory;
    protected $table = 'seer_citados';
    protected $primaryKey = 'id';
    protected $fillable = ['id_solicitud','nombre','id_municipio','id_estado'];
}