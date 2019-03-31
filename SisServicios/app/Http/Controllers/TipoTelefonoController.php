<?php

namespace SisServicios\Http\Controllers;

use Illuminate\Http\Request;
use SisServicios\TipoTelefono;

use SisServicios\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use SisServicios\Http\Requests\TipoTelefonoFormRequest;
use DB;

class TipoTelefonoController extends Controller
{
	
	public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $index=DB::table('tipo_telefono')
            ->where('descripcion','like','%'.$query.'%')
            ->where('estado','=','1')
            ->orderby('codigo_tipo_telefono','desc')
            ->paginate(5);
            return view('Mantenimientos.Tipotelefono.index',["index"=>$index,"searchText"=>$query]);
        }
    }

    public function create()
    {
        return view("Mantenimientos.Tipotelefono.create");
    }

    public function store(TipoTelefonoFormRequest $request)
    {
        $store=new TipoTelefono;
        $store->descripcion=$request->get('descripcion');
        $store->estado=(1);
        //$store->save();
echo $store->descripcion;
       // return redirect::to('Mantenimientos\Tipotelefono');
    }

    public function show($id)
    {
        return view("Mantenimientos.Tipotelefono.show",["show"=>TipoTelefono::findOrFail($id)]);
    }

    public function edit($id)
    {
        return view("Mantenimientos.Tipotelefono.edit",["edit"=>TipoTelefono::findOrFail($id)]);
    }

    public function update(TipoTelefonoFormRequest $request,$id)
    {
        $update=TipoTelefono::findorfail($id);
        $update->descripcion=$request->get('descripcion');
        $update->update();
        
        return redirect::to('Mantenimientos\Tipotelefono');
    }

    public function destroy($id)
    {
    	$destroy=TipoTelefono::findorfail($id);
    	$destroy->estado=(0);
        $destroy->update();

        return redirect::to('Mantenimientos\Tipotelefono');
    }
}
