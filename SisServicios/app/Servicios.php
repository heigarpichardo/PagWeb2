<?php

namespace SisServicios;

use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
    protected $table='servicios';
    protected $primaryKey='codigo_servicio';
    public $timestamps=false;

    protected $fillable = ['codigo_tasa','descripcion','estado'];
    protected $guarded = [];
}
