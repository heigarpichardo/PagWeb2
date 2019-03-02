<?php

namespace SisServicios\Http\Controllers;

use Illuminate\Http\Request;
use SisServicios\Servicios;

use SisServicios\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use SisServicios\Http\Requests\ServiciosFormRequest;
use DB;

class ServiciosController extends Controller
{
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $index=DB::table('servicios')
            ->where('descripcion','like','%'.$query.'%')
            ->where('estado','=','1')
            ->orderby('codigo_servicio','desc')
            ->paginate(5);
            return view('Mantenimientos.Servicios.index',["index"=>$index,"searchText"=>$query]);
        }
    }

    public function create()
    {	
    	

        return view("Mantenimientos.Servicios.create");
    }

    public function store(ServiciosFormRequest $request)
    {
        $store=new Servicios;
        $store->descripcion=$request->get('descripcion');
      //  $store->codigo_tasa=$request->get('codigo_tasa');
        $store->estado=(1);
        $store->save();

        return redirect::to('Mantenimientos\Servicios');
    }

    public function show($id)
    {
        return view("Mantenimientos.Servicios.show",["show"=>Servicios::findOrFail($id)]);
    }

    public function edit($id)
    {
        return view("Mantenimientos.Servicios.edit",["edit"=>Servicios::findOrFail($id)]);
    }

    public function update(TipoTelefonoFormRequest $request,$id)
    {
        $update=Servicios::findorfail($id);
        $update->descripcion=$request->get('descripcion');
        //$update->descripcion=$request->get('codigo_tasa');
        $update->update();
        
        return redirect::to('Mantenimientos\Servicios');
    }

    public function destroy($id)
    {
    	$destroy=Servicios::findorfail($id);
    	$destroy->estado=(0);
        $destroy->update();

        return redirect::to('Mantenimientos\Servicios');
    }
}
