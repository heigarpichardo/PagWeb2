<?php

namespace SisServicios;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $table='ciudad';
    protected $primaryKey='id_ciudad';
    public $timestamps=false;

    protected $fillable = ['ciudad'];
    protected $guarded = [];
}
