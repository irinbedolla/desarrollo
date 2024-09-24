<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeerNotificadores extends Model
{
    //use HasFactory;
    protected $table = 'estadisticas_notificadores';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','citatorios','asesorias_notificador','solicitudes_levantadas','ratificaciones_notificador','razon_registrada','multas_notificador','informe_diario',
    'informe_foraneo','integrar_expediente','escaneo_documentos', 'fecha', 'delegacion'];

}
