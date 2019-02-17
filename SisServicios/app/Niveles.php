<?php

namespace sisColegio;

use Illuminate\Database\Eloquent\Model;

class Niveles extends Model
{
    protected $table='nivel';

    protected $primaryKey='id_nivel';

    public $timestamps=false;

    protected $fillable=[
    	'descripcion'
    ];
}
