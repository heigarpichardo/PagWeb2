<?php

namespace sisColegio;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table='roles';

    protected $primaryKey='id_roles';

	protected $fillable=[
    	'descripcion'
    ];
    public $timestamps=false;

    public function fnpersonas()
    {
    	/*return $this->hasMany('App\Personas','persona_roles')->withPivot('id_persona','nombre');*/
        return $this->belongsToMany('App\Personas')->withPivot('persona_roles','id_persona','nombre');
    }
}
