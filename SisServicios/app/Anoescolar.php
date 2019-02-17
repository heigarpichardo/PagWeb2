<?php

namespace SisServicios;

use Illuminate\Database\Eloquent\Model;

class Anoescolar extends Model
{
    protected $table='año_escolar';
    protected $primaryKey='id_año_escolar';
    public $timestamps=false;
    
    protected $fillable = ['descripcion','fecha_ini','fecha_fin'];
    protected $guarded = [];
}
