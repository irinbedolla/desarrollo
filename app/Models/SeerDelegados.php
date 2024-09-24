<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeerDelegados extends Model
{
    //use HasFactory;
    protected $table = 'estadisticas_delegados';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','personas_atendidas', 'asesorias', 'solicitudes_inicio', 'audiencias_programadas', 'audiencias_celebradas', 
    'solicitudes_incopetencia', 'convenio_audiencia', 'ratificacion_convenios', 'monto_convenios', 'notificaciones', 
    'contancia_no_conciliacion', 'contancia_no_conciliacion_patron', 'contancia_no_conciliacion_notificacion', 'solicitudes_archivadas', 'colectivas', 
    'mujeres', 'hombres', 'despido_injitificado', 'finiquito', 'derecho_preferencia', 
    'pago_prestaciones', 'terminacion_volintaria', 'supuesto_excepciones', 'otros', 'multas', 'cincuenta_umas', 'cien_umas', 'otro_monto',
    'fecha', 'delegacion'];

}
