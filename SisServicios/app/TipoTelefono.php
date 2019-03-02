<?php

namespace SisServicios;

use Illuminate\Database\Eloquent\Model;

class TipoTelefono extends Model
{
    protected $table='tipo_telefono';
    protected $primaryKey='codigo_tipo_telefono';
    public $timestamps=false;

    protected $fillable = ['descripcion','estado'];
    protected $guarded = [];
}
