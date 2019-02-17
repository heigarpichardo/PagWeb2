<?php

namespace SisServicios\Http\Controllers;

use Illuminate\Http\Request;

use SisServicios\Http\Requests;
use SisServicios\Cuotas;

use Illuminate\Support\Facades\Redirect;
use SisServicios\Http\Requests\CobrosFormRequest;

use Carbon\Carbon;
use DB;

class CobrosController extends Controller
{
    public function _contructor()
    {

    }
    public function index(Request $request)
    {
    	if ($request)
    	{
    		$query=trim($request->get('searchText'));
    		$cobros=DB::table('historial_detalle_cobros as det')
    		->join('inscripcion as i','det.id_inscripcion','=','i.id_inscripcion')
    		->join('estudiante as est','i.id_estudiante','=','est.id_estudiante')
    		->join('persona as per','est.id_persona','=','per.id_persona')
    		->select('est.id_estudiante','per.nom_persona','per.ape_persona','est.matricula','det.id_cuotas','det.monto','det.fecha','det.id_empleado','det.comentario')
            //->where('ciudad','like','%'.$query.'%')
            ->orderby('det.fecha','desc')
            ->paginate(10);

    		return view('procesos.cobros.index',["cobros"=>$cobros,"searchText"=>$query]);
    	}
    }

    public function create(Request $request)
    {
    	if ($request)
    	{
	    	$query=trim($request->get('searchText'));
		    $cuotas=DB::table('cuotas_estudiantes as det')
			->join('inscripcion as i','det.id_inscripcion','=','i.id_inscripcion')
			->join('estudiante as est','i.id_estudiante','=','est.id_estudiante')
			->join('persona as per','est.id_persona','=','per.id_persona')
			->select('est.id_estudiante','per.nom_persona','per.ape_persona','est.matricula','det.id_cuotas','det.monto','det.fecha','det.balance')
	        ->where('det.balance','>=','0.00')
	        ->where('est.id_estudiante','like','%'.$query.'%')
	        ->orwhere(DB::raw('CONCAT_WS(" ", per.nom_persona, per.ape_persona)'),'LIKE','%'.$query.'%')
	        ->orderby('det.fecha','desc')
	        ->paginate(5);
            //->get();
	        //var_dump($cuotas);
	    	return view("procesos.cobros.create",["cuotas"=>$cuotas,"searchText"=>$query]);
    	}
    }
    public function store(CobrosFormRequest $request)
    {
          	
        $id_cuotas=$request->get('id_cuotas');
        var_dump($id_cuotas);
    	/*$monto=$request->get('monto');
    	$fecha=$request->get('fecha');
    	$id_empleado=(1);
    	$comentario=$request->get('comentario');
    	
    	$cont = 0;*/



        /*while ($cont <= count($id_cuotas))
        $cobros=new cobros;
    	$cobros->save();*/

    	//return redirect::to('procesos\cobros');
    	//return view("procesos.cobros.create");
    }
    public function show($id)
    {
    	//return view("procesos.cobros.show",["ciudad"=>ciudad::findOrFail($id)]);
    }
    public function edit($id)
    {
    	//return view("procesos.cobros.edit",["ciudad"=>ciudad::findOrFail($id)]);
    }
    public function update(CobrosFormRequest $request,$id)
    {
    	$cobros=cobros::findorfail($id);
    	$cobros->cobros=$request->get('ciudad');
    	$cobros->update();
    	return redirect::to('procesos.cobros');
    }
    public function destroy($id)
    {
    	$cobros=cobros::findorfail($id);
    	$cobros->estado=(1);
    	$cobros->update();

    	return redirect::to('procesos.cobros');
    }
}
