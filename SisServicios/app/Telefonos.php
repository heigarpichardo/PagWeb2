<?php

namespace SisServicios;

use Illuminate\Database\Eloquent\Model;

class Telefonos extends Model
{
    protected $table='telefonos';
    protected $primaryKey='codigo_telefono';
    public $timestamps=false;

    protected $fillable = ['descripcion','estado','tipo_telefono'];
    protected $guarded = [];
}
