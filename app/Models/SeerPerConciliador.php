<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeerPerConciliador extends Model
{
    //use HasFactory;
    protected $table = 'seer_conciliadores';
    protected $primaryKey = 'id';
    protected $fillable = ['id_solicitud','numero_audiencia', 'estatus_conciliacion', 'monto', 'cumplimiento_pago','observaciones','multa','tipo'];

}
