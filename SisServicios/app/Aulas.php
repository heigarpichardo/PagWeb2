<?php

namespace sisColegio;

use Illuminate\Database\Eloquent\Model;

class Aulas extends Model
{
    protected $table='aula';

    protected $primaryKey='id_aula';

    public $timestamps=false;

    protected $fillable=[
    	'id_nivel',
    	'id_seccion',
    	'descripcion'
    ];
       public function fnniveles() {
        return $this->belongsTo('App\Niveles', 'foreign_key');
    }
}
