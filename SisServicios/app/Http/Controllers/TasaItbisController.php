<?php

namespace SisServicios\Http\Controllers;

use SisServicios\TasaItbis;
use Illuminate\Http\Request;

use SisServicios\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use SisServicios\Http\Requests\TasaItbisFormRequest;
use DB;

class TasaItbisController extends Controller
{
    
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $tasa_itbis=DB::table('tasa_itbis')
            ->where('descripcion','like','%'.$query.'%')
            ->orderby('codigo_tasa','desc')
            ->paginate(5);    
            return view('Mantenimientos.TasaItbis.index',["tasa_itbis"=>$tasa_itbis,"searchText"=>$query]);
        }
    }

    public function create()
    {
        return view("Mantenimientos.Tasaitbis.create");
    }

    public function store(TasaItbisFormRequest $request)
    {
        $store=new TasaItbis;
        $store->descripcion=$request->get('descripcion');
        $store->tasa=$request->get('tasa');
        $store->save();

        return redirect::to('Mantenimientos\Tasaitbis');
    }

    public function show($id)
    {
        return view("Mantenimientos.Tasaitbis.show",["Tasa_Itbis"=>TasaItbis::findOrFail($id)]);
    }

    public function edit($id)
    {
        return view("Mantenimientos.Tasaitbis.edit",["Tasa_Itbis"=>TasaItbis::findOrFail($id)]);
    }

    public function update(TasaItbisFormRequest $request,$id)
    {
        $update=TasaItbis::findorfail($id);
        $update->descripcion=$request->get('descripcion');
        $update->tasa=$request->get('tasa');
        $update->update();
        
        return redirect::to('Mantenimientos\Tasaitbis');
    }

    public function destroy($id)
    {
        return redirect::to('Mantenimientos\Tasaitbis');
    }
}
