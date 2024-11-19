<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeerConvenios extends Model
{
    //use HasFactory;
    protected $table = 'seer_convenios';
    protected $primaryKey = 'id';
    protected $fillable = ['conciliador','fecha','NUE', 'solicitante', 'citado', 'monto', 'tipo_pago','estatus'];

}
