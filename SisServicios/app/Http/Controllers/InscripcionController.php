<?php

namespace SisServicios\Http\Controllers;

use Illuminate\Http\Request;

use SisServicios\Http\Requests;
use SisServicios\Inscripcion;
use SisServicios\Estudiantes;
use SisServicios\Cuotas;
use SisServicios\Anoescolar;

use Illuminate\Support\Facades\Redirect;
use SisServicios\Http\Requests\InscripcionFormRequest;
//use SisServicios\Http\Controllers\EstudianteController;

use Carbon\Carbon;
use DB;

class InscripcionController extends Controller
{
    public function _contructor()
    {

    }
    public function index(Request $request)
    {
    	/*if ($request)
    	{
    		$query=trim($request->get('searchText'));
    		$ciudades=DB::table('ciudad')
            ->where('ciudad','like','%'.$query.'%')
            ->orderby('id_ciudad','desc')
            ->paginate(5);    
    		return view('procesos.inscripcion.index',["ciudades"=>$ciudades,"searchText"=>$query]);
    	}*/
        if ($request)
        {
            $query=trim($request->get('searchText'));

            /*$id_roles = 1;
            $personas = Personas::whereHas('fnroles', function($query2) use($id_roles) {
            $query2->where('id_roles', $id_roles);})->get();*/

            $estudiantes=DB::table('estudiante as e')
            ->join('persona as p','e.id_persona','=','p.id_persona')
            ->join('aula','e.id_aula','=','aula.id_aula')
            ->join('seccion','aula.id_seccion','=','seccion.id_seccion')
            ->join('nivel','aula.id_nivel','=','nivel.id_nivel')
            ->select('e.id_estudiante as id_estudiante','p.nom_persona as nombre','p.ape_persona as apellido','aula.descripcion as aula','seccion.descripcion as seccion','nivel.descripcion as nivel','e.matricula as matricula')
            ->where(DB::raw('CONCAT_WS(" ", p.nom_persona, p.ape_persona)'),'LIKE','%'.$query.'%')
            ->orderBy('e.id_estudiante','desc')
            ->paginate(7);

            return view('procesos.inscripcion.index',["estudiantes" => $estudiantes,"searchText" => $query]);
        }
    }

    public function create()
    {
        //$estudiante=Estudiantes::findOrFail($id);
    	return view("procesos.inscripcion.create",["estudiante"=>Estudiantes::findOrFail(1)]);
    }
    public function store(InscripcionFormRequest $request)
    {
    	$inscripcion=new Inscripcion;
    	$inscripcion->id_estudiante=$request->get('id_estudiante');
    	$inscripcion->id_año_escolar=$request->get('id_año_escolar');
    	$inscripcion->id_nivel=$request->get('id_nivel');
    	$inscripcion->fecha_inscripcion=$request->get('fecha_inscripcion');
    	$inscripcion->monto=$request->get('monto');
    	$inscripcion->descuento=$request->get('descuento');
    	$inscripcion->balance=$request->get('monto');
    	$inscripcion->estado=(0);
    	$inscripcion->save();

    	if($inscripcion->save()){

    		$ano_escolar=Anoescolar::findorfail($request->get('id_año_escolar'));
    		
    		$inscripcion=DB::table('Inscripcion')
    			->select('id_inscripcion')
    			->orderby('id_inscripcion','desc')
            	->first();
            
    		$numcuotas=DB::table('año_escolar')
    		->select(DB::raw("timestampdiff(MONTH,fecha_ini,fecha_fin) + 1 as num "))
    		->where('id_año_escolar','=',$ano_escolar->id_año_escolar)
    		->first();

    		$montocuotas = 500;
    		$num=$numcuotas->num;
    		
    		$date = new carbon($ano_escolar->fecha_ini);
    		
    		for ($i = 1; $i <= $num; $i++){
    			$cuotas=new Cuotas;
		    	$cuotas->id_inscripcion=$inscripcion->id_inscripcion;
		    	$cuotas->fecha=$date;
		    	$cuotas->monto=$montocuotas;
		    	$cuotas->balance=$montocuotas;
		    	$cuotas->save();
		    	$date->addMonth(1);
			}
		}

    	return redirect::to('procesos\inscripcion');
    }
    public function show($id)
    {
    	//return view("procesos.inscripcion.show",["ciudad"=>ciudad::findOrFail($id)]);
    }
    public function edit($id)
    {
    	//return view("procesos.inscripcion.edit",["ciudad"=>ciudad::findOrFail($id)]);
    }
    public function update(InscripcionFormRequest $request,$id)
    {
    	$inscripcion=Inscripcion::findorfail($id);
    	$inscripcion->inscripcion=$request->get('ciudad');
    	$inscripcion->update();
    	return redirect::to('procesos.inscripcion');
    }
    public function destroy($id)
    {
    	$inscripcion=Inscripcion::findorfail($id);
    	$inscripcion->estado=(1);
    	$inscripcion->update();

    	return redirect::to('procesos.inscripcion');
    }
}
