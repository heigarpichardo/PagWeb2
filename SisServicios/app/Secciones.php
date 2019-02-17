<?php

namespace sisColegio;

use Illuminate\Database\Eloquent\Model;

class Secciones extends Model
{
    protected $table='seccion';

    protected $primaryKey='id_seccion';

    public $timestamps=false;

    protected $fillable=[
    	'descripcion',
    ];

}
