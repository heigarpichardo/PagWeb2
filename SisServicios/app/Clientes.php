<?php

namespace SisServicios;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table='clientes';
    protected $primaryKey='codigo_cliente';
    public $timestamps=false;

    protected $fillable = ['apellido','balance','codigo_persona','limite_credito'];
    protected $guarded = [];
}
