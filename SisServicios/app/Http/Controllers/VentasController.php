<?php

namespace SisServicios\Http\Controllers;

use Illuminate\Http\Request;

use SisServicios\Http\Requests;
use Barryvdh\DomPDF\Facade as PDF;
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
    		$index=DB::table('personas as per')
    		->join('tipo_persona as tip','tip.codigo_tipo_persona','=','per.codigo_tipo_persona')
    		->join('clientes as cli','cli.codigo_persona','=','per.codigo_persona')
    		->select('cli.codigo_cliente','per.nombre','cli.apellido','per.documento','cli.balance')
    		->where(DB::raw('CONCAT_WS(" ", per.nombre, cli.apellido)'),'LIKE','%'.$query.'%')
            ->orderby('per.nombre','desc')
            ->paginate(10);

            return view('procesos.Ventas.index',["index"=>$index,"searchText"=>$query]);
        }
    }

    public function createp($id)
    {
    	$cliente=DB::table('personas as per')
    		->join('tipo_persona as tip','tip.codigo_tipo_persona','=','per.codigo_tipo_persona')
    		->join('clientes as cli','cli.codigo_persona','=','per.codigo_persona')
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

    //    try
      //  {
        //    DB::beginTransaction();  
   
            $comprobante=Comprobantes::findOrFail($request->get('tipo_ncf'))->first();

            $NCF=$comprobante->serial.str_pad($comprobante->tipo, 2,'0',STR_PAD_LEFT)
            .str_pad($comprobante->secuencia+1, 8,'0',STR_PAD_LEFT);

            $secuencia = $comprobante->secuencia;
            $comprobante->secuencia= $secuencia+1;
           // $comprobante->update();

            $date = new carbon();

            $ventas=new Ventas;
            $ventas->codigo_persona=$request->get('id_cliente');
            $ventas->NCF=$NCF;//$request->get('NCF');
            $ventas->tipo_venta=$request->get('tipoventa');
            $ventas->condicion=$request->get('condicion');
            $ventas->fecha=$date->todatestring();   $date->addday($request->get('condicion'));//$request->get('descripcion');
            $ventas->fecha_vencimiento=$date->todatestring();//$request->get('descripcion');
            $ventas->total_itbis=500;//$request->get('descripcion');
            $ventas->total_descuentos=500;//$request->get('descripcion');
            $ventas->total_importe=500;//$request->get('descripcion');
            $ventas->total_factura=500;//$request->get('descripcion');
            $ventas->hora=$date->toTimeString();//$request->get('descripcion');
            $ventas->codigo_usuario=Auth::user()->id;//$request->get('descripcion');
           // $Ventas->save();
            

            $idarticulo = $request->get('idart');
            $cantidad = $request->get('cant');
            $monto = $request->get('monto');

            $cont = 0;
            $arreglo = array();

            while($cont < count($idarticulo))
            {
                $detventas = new Detventas();
                $detventas->codigo_ventas = $ventas->codigo_venta;
                $detventas->codigo_servicio = $idarticulo[$cont];
                $detventas->descripcion_servicio=("");
                $detventas->monto_itbis = (500);
                $detventas->monto_importe = (500);
                $detventas->monto_descuento = (500);
                $detventas->monto_total = (500);
             //   $Detventas->save();
                $arreglo[] = $detventas;
                $cont = $cont + 1;
            }
         
      //  $data = ['title' => 'Factura'];
     //   $data = ['venta' => $ventas];
       // $data = ['detalles' => $detventas];
        $pdf=PDF::loadView('myPDF',['venta' => $ventas, 'detalles' => $arreglo]);
        return $pdf->download('Factura.pdf');



       //       DB::commit();
       // }
       // catch(\Exception $e)
       // {
          
         //   DB::rollback();
       // }

 //   return redirect::to('procesos/Ventas');
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
