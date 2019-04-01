<?php

namespace SisServicios\Http\Controllers;

use Illuminate\Http\Request;

use SisServicios\Http\Requests;
use SisServicios\Ciudad;
use Illuminate\Support\Facades\Redirect;
use SisServicios\Http\Requests\VentasFormRequest;

use Carbon\Carbon;
use DB;

class VentasController extends Controller
{
     public function _contructor()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
    		$index=DB::table('persona as per')
    		->join('tipo_persona as tip','tip.codigo_tipo_persona','=','per.codigo_tipo_persona')
    		->join('cliente as cli','cli.codigo_persona','=','per.codigo_persona')
    		->select('cli.codigo_cliente','per.nombre','cli.apellido','per.documento','cli.balance')
    		->where(DB::raw('CONCAT_WS(" ", per.nombre, cli.apellido)'),'LIKE','%'.$query.'%')
            ->orderby('per.nombre','desc')
            ->paginate(10);

            return view('procesos.Ventas.index',["index"=>$index,"searchText"=>$query]);
        }
    }

    public function create()
    {
        return view("procesos.Ventas.create");
    }

    public function store(VentasFormRequest $request)
    {
        $store=new TipoTelefono;
        $store->descripcion=$request->get('descripcion');
        $store->estado=(1);
        $store->save();

        return redirect::to('procesos.Ventas');
    }

    public function show($id)
    {
        return view("procesos.Ventas.show",["show"=>TipoTelefono::findOrFail($id)]);
    }

    public function edit($id)
    {
        return view("procesos.Ventas.edit",["edit"=>TipoTelefono::findOrFail($id)]);
    }

    public function update(VentasFormRequest $request,$id)
    {
        $update=TipoTelefono::findorfail($id);
        $update->descripcion=$request->get('descripcion');
        $update->update();
        
        return redirect::to('procesos.Ventas');
    }

    public function destroy($id)
    {
    	$destroy=TipoTelefono::findorfail($id);
    	$destroy->estado=(0);
        $destroy->update();

        return redirect::to('procesos.Ventas');
    }
}
