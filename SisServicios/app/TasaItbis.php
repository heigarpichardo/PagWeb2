<?php

namespace SisServicios;

use Illuminate\Database\Eloquent\Model;

class TasaItbis extends Model
{
    protected $table='tasa_itbis';
    protected $primaryKey='codigo_tasa';
    public $timestamps=false;

    protected $fillable = ['descripcion','tasa'];
    protected $guarded = [];
}
