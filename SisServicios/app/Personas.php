<?php

namespace SisServicios;

use Illuminate\Database\Eloquent\Model;

class Personas extends Model
{
    protected $table='personas';
    protected $primaryKey='codigo_persona';
    public $timestamps=false;

    protected $fillable = ['codigo_tipo_persona','documento','estado','nombre','tipo_NCF'];
    protected $guarded = [];
}
