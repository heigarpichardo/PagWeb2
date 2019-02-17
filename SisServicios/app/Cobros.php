<?php

namespace SisServicios;

use Illuminate\Database\Eloquent\Model;

class Cobros extends Model
{
    protected $table='historial_detalle_cobros';
    protected $primaryKey='id_cobro';
    public $timestamps=false;
    
    protected $fillable = ['id_cuotas','monto','fecha','id_empleado','id','comentario'];
    protected $guarded = [];
}
