<?php

namespace SisServicios\Http\Controllers;

use Illuminate\Http\Request;

use SisServicios\Http\Requests;

use SisServicios\Ventas;
use SisServicios\Detventas;
use SisServicios\Comprobantes;
use SisServicios\Servicios;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
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

        try
        {
            DB::beginTransaction();  
   
            $comprobante=Comprobantes::findOrFail($request->get('tipo_ncf'))->first();

            $NCF=$comprobante->serial.str_pad($comprobante->tipo, 2,'0',STR_PAD_LEFT)
            .str_pad($comprobante->secuencia+1, 8,'0',STR_PAD_LEFT);

            $secuencia = $comprobante->secuencia;
            $comprobante->secuencia= $secuencia+1;
            $comprobante->update();

            $date = new carbon();

            $Ventas=new Ventas;
            $Ventas->codigo_persona=$request->get('id_cliente');
            $Ventas->NCF=$NCF;//$request->get('NCF');
            $Ventas->tipo_venta=$request->get('tipoventa');
            $Ventas->condicion=$request->get('condicion');
            $Ventas->fecha=$date->todatestring();   $date->addday($request->get('condicion'));//$request->get('descripcion');
            $Ventas->fecha_vencimiento=$date->todatestring();//$request->get('descripcion');
            $Ventas->total_itbis=500;//$request->get('descripcion');
            $Ventas->total_descuentos=500;//$request->get('descripcion');
            $Ventas->total_importe=500;//$request->get('descripcion');
            $Ventas->total_factura=500;//$request->get('descripcion');
            $Ventas->hora=$date->toTimeString();//$request->get('descripcion');
            $Ventas->codigo_usuario=Auth::user()->id;//$request->get('descripcion');
            $Ventas->save();

            $idarticulo = $request->get('idart');
            $cantidad = $request->get('cant');
            $monto = $request->get('monto');

            $cont = 0;

            while($cont < count($idarticulo))
            {
                $Detventas = new Detventas();
                $Detventas->codigo_ventas = $Ventas->codigo_venta;
                $Detventas->codigo_servicio = $idarticulo[$cont];
                $Detventas->descripcion_servicio=("");
                $Detventas->monto_itbis = (500);
                $Detventas->monto_importe = (500);
                $Detventas->monto_descuento = (500);
                $Detventas->monto_total = (500);
                $Detventas->save();
                $cont = $cont + 1;
            }
              DB::commit();
        }
        catch(\Exception $e)
        {
            DB::rollback();
        }

        return redirect::to('procesos/Ventas');
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
