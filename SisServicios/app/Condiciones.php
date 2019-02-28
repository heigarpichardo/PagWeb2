<?php

namespace SisServicios;

use Illuminate\Database\Eloquent\Model;

class Condiciones extends Model
{
    protected $table='Tipo_Persona';
    protected $primaryKey='codigo_tipo_persona';
    public $timestamps=false;

    protected $fillable = ['descripcion','estado'];
    protected $guarded = [];
}
