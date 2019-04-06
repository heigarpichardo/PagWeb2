<?php

namespace SisServicios;

use Illuminate\Database\Eloquent\Model;

class Detventas extends Model
{
    protected $table='detalle_ventas';
    
    protected $primaryKey = null;
    public $incrementing = false;
    
    public $timestamps=false;

    protected $fillable = ['codigo_ventas','codigo_servicio','descripcion_servicio','monto_itbis','monto_importe','monto_descuento','monto_total'];
    protected $guarded = [];
}
