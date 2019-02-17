<?php

namespace SisServicios;

use Illuminate\Database\Eloquent\Model;

class Cuotas extends Model
{
    protected $table='cuotas_estudiantes';
    protected $primaryKey='id_cuotas';
    public $timestamps=false;
    
    protected $fillable = ['id_inscripcion','fecha','monto','balance'];
    protected $guarded = [];
}
