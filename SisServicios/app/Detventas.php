<?php

namespace SisServicios;

use Illuminate\Database\Eloquent\Model;

class Detventas extends Model
{
    protected $table='detalle_ventas';
    protected $primaryKey='';
    public $timestamps=false;

    protected $fillable = ['codigo_venta','codigo_servicio','descripcion_servicio','monto_itbis','monto_importe','monto_descuento','monto_total'];
    protected $guarded = [];
}
