<?php

namespace sisColegio;

use Illuminate\Database\Eloquent\Model;

class Personas extends Model
{
    protected $table='persona';

    protected $primaryKey='id_persona';

    public $timestamps=false;

    protected $fillable=[
    	'nom_persona',
    	'ape_persona',
    	'sexo',
    	'fecha_nac',
    	'estado_civil',
        'id_condicion'
    ];

    public function fnroles()
    {
    	/*return $this->belongsToMany('App\Roles','persona_roles')->withPivot('id_roles','nombre');*/
        return $this->belongsToMany('App\Roles')->withPivot('persona_roles','id_roles','nombre');
    }
    public function fnestudiantes()
    {
        return $this->belongsTo('App\Estudiantes');
    }

    public function fncondiciones() {
        return $this->belongsTo('App\Condiciones', 'foreign_key');
    }
}
