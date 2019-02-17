<?php

namespace SisServicios;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table='inscripcion';
    protected $primaryKey='id_inscripcion';
    public $timestamps=false;

    protected $fillable = ['id_estudiante','id_año_escolar','id_nivel','fecha_inscripcion','monto','descuento','balance'];
    protected $guarded = [];
}
