<?php

namespace SisServicios;

use Illuminate\Database\Eloquent\Model;

class Comprobantes extends Model
{
    protected $table='comprobantes';
    protected $primaryKey='codigo';
    public $timestamps=false;

    protected $fillable = ['final','secuencia','serial','tipo'];
    protected $guarded = [];
}
