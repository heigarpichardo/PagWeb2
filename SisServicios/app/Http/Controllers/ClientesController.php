<?php

namespace SisServicios\Http\Controllers;

use Illuminate\Http\Request;
use SisServicios\Clientes;
use SisServicios\Personas;
use SisServicios\Telefonos;

use SisServicios\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use SisServicios\Http\Requests\ClientesFormRequest;
use SisServicios\Http\Requests\PersonasFormRequest;
use SisServicios\Http\Requests\TelefonosFormRequest;
use DB;


class ClientesController extends Controller
{
     public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $index=DB::table('clientes')
            //->selectraw("CONCAT('personas.nombre',' ','clientes.apellido') as nombre, apellido,balance,limite_credito")
            ->join('personas', 'personas.codigo_persona', '=', 'clientes.codigo_persona')	
           // ->orWhereRaw("CONCAT('personas.nombre',' ','clientes.apellido') LIKE ?",["%".$query."%"])
           // ->where('and estado','=','1')
            ->orderby('codigo_cliente','desc')
            ->paginate(5);
            return view('Mantenimientos.Clientes.index',["index"=>$index,"searchText"=>$query]);
        }
    }

    public function create()
    {	
        $tipo_telefono=DB::table('tipo_telefono')-> get();
        return view("Mantenimientos.Clientes.create",["tipo_telefono"=>$tipo_telefono]);
    }

    public function store(ClientesFormRequest $request)
    {
        $store=new Personas;
        $store->codigo_tipo_persona=1;
        $store->estado=(1);
        $store->nombre=$request->get('nombre');
        $store->tipo_NCF=$request->get('tipo_NCF');
        $store->documento=$request->get('documento');
        $store->save();
        $codigo = $store->codigo_persona;

        $telefono = $request->get('telefono');
        if(!empty($telefono)){
            $store_telefonos=new Telefonos;
            $store_telefonos->codigo_persona=$store->codigo_persona;;
            $store_telefonos->descripcion=$telefono;
            $store_telefonos->estado=(1);
            $store_telefonos->tipo_telefono=$request->get('tipo_telefono');
            $store_telefonos->save();
        }

        $store_clientes=new Clientes;
        $store_clientes->apellido=$request->get('apellido');
        $store_clientes->balance=0;
        $store_clientes->codigo_persona=$store->codigo_persona;
        $store_clientes->limite_credito=$request->get('Limite_credito');
        $store_clientes->save();

        return redirect::to('Mantenimientos\Clientes');
    }

    public function show($id)
    {
        return view("Mantenimientos.Clientes.show",["show"=>Clientes::findOrFail($id)]);
    }

    public function edit($id)
    {
        $tipo_telefono=DB::table('tipo_telefono')-> get();
        return view("Mantenimientos.Clientes.edit",["edit"=>Clientes::findOrFail($id)],["tipo_telefono"=>$tipo_telefono]);
    }

    public function update(ClientesFormRequest $request,$id)
    {
        $store=new Personas;
        $store->codigo_tipo_persona=1;
        $store->estado=(1);
        $store->nombre=$request->get('nombre');
        $store->tipo_NCF=$request->get('tipo_NCF');
        $store->documento=$request->get('documento');
        $store->update();
        $codigo = $store->codigo_persona;

        $telefono = $request->get('telefono');
        if(!empty($telefono)){
            $store_telefonos=new Telefonos;
            $store_telefonos->codigo_persona=$store->codigo_persona;;
            $store_telefonos->descripcion=$telefono;
            $store_telefonos->estado=(1);
            $store_telefonos->tipo_telefono=$request->get('tipo_telefono');
            $store_telefonos->update();
        }

        $store_clientes=new Clientes;
        $store_clientes->apellido=$request->get('apellido');
        $store_clientes->balance=0;
        $store_clientes->codigo_persona=$store->codigo_persona;
        $store_clientes->limite_credito=$request->get('Limite_credito');
        $store_clientes->update();

        return redirect::to('Mantenimientos\Clientes');
    }

    public function destroy($id)
    {
    	$destroy=Personas::findorfail($id);
    	$destroy->estado=(0);
        $destroy->update();

        return redirect::to('Mantenimientos\Clientes');
    }
}
