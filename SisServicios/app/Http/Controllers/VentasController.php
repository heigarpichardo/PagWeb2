<?php

namespace SisServicios\Http\Controllers;

use Illuminate\Http\Request;

use SisServicios\Http\Requests;

use SisServicios\Ventas;
use SisServicios\Detventas;
use SisServicios\Comprobantes;
use SisServicios\Servicios;
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

    public function createp($id)
    {
    	$cliente=DB::table('persona as per')
    		->join('tipo_persona as tip','tip.codigo_tipo_persona','=','per.codigo_tipo_persona')
    		->join('cliente as cli','cli.codigo_persona','=','per.codigo_persona')
    		->select('cli.codigo_cliente','per.nombre as nombre','cli.apellido','per.documento','cli.balance','per.tipo_ncf')
    		->where('cli.codigo_cliente','=',$id)
    		->first();

    	$comprobante=Comprobantes::findOrFail($cliente->tipo_ncf)->first();

    	//'final','secuencia','serial','tipo'

    	$NCF=$comprobante->serial.str_pad($comprobante->tipo, 2,'0',STR_PAD_LEFT).str_pad($comprobante->secuencia+1, 8,'0',STR_PAD_LEFT);
    	//$NCF=str_pad($comprobante->secuencia+1, 8,'0',STR_PAD_LEFT);
    	//var_dump($comprobante);
    	$servicios=Servicios::all();
    	//var_dump($servicios);
        return view("procesos.Ventas.create",["cliente" => $cliente,"NCF" =>$NCF,"articulo" => $servicios]);
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
