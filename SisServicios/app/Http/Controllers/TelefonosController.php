<?php

namespace SisServicios\Http\Controllers;

use Illuminate\Http\Request;
use SisServicios\Telefonos;

use SisServicios\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use SisServicios\Http\Requests\TelefonosFormRequest;
use DB;


class TelefonosController extends Controller
{
     public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $index=DB::table('telefonos')
            ->where('descripcion','like','%'.$query.'%')
            ->where('estado','=','1')
            ->orderby('codigo_telefono','desc')
            ->paginate(5);
            return view('Mantenimientos.Telefonos.index',["index"=>$index,"searchText"=>$query]);
        }
    }

    public function create()
    {	
    	
    	$tasas=DB::table('tipo_telefono')-> get();
        return view("Mantenimientos.Telefonos.create",["tipo_telefono"=>$tipo_telefono]);
    }

    public function store(TelefonosFormRequest $request)
    {
        $store=new Servicios;
        $store->descripcion=$request->get('descripcion');
        $store->tipo_telefono=$request->get('tipo_telefono');
        $store->estado=(1);
        $store->save();

        return redirect::to('Mantenimientos\Telefonos');
    }

    public function show($id)
    {
        return view("Mantenimientos.Telefonos.show",["show"=>Telefonos::findOrFail($id)]);
    }

    public function edit($id)
    {
    	$tasas=DB::table('tipo_telefono')-> get();
        return view("Mantenimientos.Telefonos.edit",["edit"=>Telefonos::findOrFail($id)],["tipo_telefono"=>$tipo_telefono]);
    }

    public function update(TelefonosFormRequest $request,$id)
    {
        $update=Servicios::findorfail($id);
        $update->descripcion=$request->get('descripcion');
        $update->descripcion=$request->get('tipo_telefono');
        $update->update();
        
        return redirect::to('Mantenimientos\Telefonos');
    }

    public function destroy($id)
    {
    	$destroy=Telefonos::findorfail($id);
    	$destroy->estado=(0);
        $destroy->update();

        return redirect::to('Mantenimientos\Telefonos');
    }
}
