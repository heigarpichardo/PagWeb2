<?php

namespace sisColegio;

use Illuminate\Database\Eloquent\Model;

class Estudiantes extends Model
{
    protected $table='estudiante';

    protected $primaryKey='id_estudiante';

    public $timestamps=false;

    protected $fillable=[
    	'id_persona',
    	'id_aula',
    	'matricula',
    	'clave',
    	'estudiante_reg'
    ];

    public function fnpersonas() {
        return $this->hasOne('App\Persona', 'foreign_key');
    }

    public function fnaulas() {
        return $this->belongsTo('App\Aula', 'foreign_key');
    }
}
