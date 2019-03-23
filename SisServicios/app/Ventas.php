<?php

namespace SisServicios;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $table='ventas';
    protected $primaryKey='codigo_venta';
    public $timestamps=false;

    protected $fillable = ['codigo_persona','NCF','tipo_venta','condicion','fecha','fecha_vencimiento','total_itbis','total_importe','total_factura','hora','codigo_usuario'];
    protected $guarded = [];
}
