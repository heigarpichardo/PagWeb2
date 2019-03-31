<?php

namespace SisServicios\Http\Controllers;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use SisServicios\Comprobantes;
use SisServicios\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use SisServicios\Http\Requests\ComprobantesFormRequest;
use DB;

class ComprobantesController extends Controller
{
    	public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $index=DB::table('comprobantes')
           // ->where('tipo','=', $query)
            //->where('estado','=','1')
            ->orderby('codigo','desc')
            ->paginate(5);
            return view('Mantenimientos.Comprobantes.index',["index"=>$index,"searchText"=>$query]);
        }
    }

    public function create()
    {
        return view("Mantenimientos.Comprobantes.create");
    }

    public function store(ComprobantesFormRequest $request)
    {
      $serial = $request->get('arreglo_serial'); 
      $tipo= $request->get('arreglo_tipo');
      $secuencia= $request->get('arreglo_secuencia');
      $final= $request->get('arreglo_final');
      //$cantidad = $request->get('cantidad');
      $cont = 0;

    while($cont < count($serial)){
        $store=new Comprobantes;
        $store->serial= $serial[$cont];
        $store->final= $final[$cont];
        $store->secuencia= $secuencia[$cont];
        $store->tipo= $tipo[$cont];
        $cont = $cont + 1;
        
      $store->save();
    }
        return redirect::to('Mantenimientos\Comprobantes');
    }


    public function show($id)
    {
        return view("Mantenimientos.Comprobantes.show",["show"=>Comprobantes::findOrFail($id)]);
    }

    public function edit($id)
    {
        return view("Mantenimientos.Comprobantes.edit",["edit"=>Comprobantes::findOrFail($id)]);
    }

    public function update(ComprobantesFormRequest $request,$id)
    {
        $update=Comprobantes::findorfail($id);
        $update->final=$request->get('final');
        $update->secuencia=$request->get('secuencia');
        $update->serial=$request->get('serial');
        $update->tipo=$request->get('tipo');
        $update->update();
        
        return redirect::to('Mantenimientos\Comprobantes');
    }

    public function destroy($id)
    {
    	$destroy=Comprobantes::findorfail($id);
    	//$destroy->estado=(0);
        $destroy->delete();

        return redirect::to('Mantenimientos\Comprobantes');
    }
}
