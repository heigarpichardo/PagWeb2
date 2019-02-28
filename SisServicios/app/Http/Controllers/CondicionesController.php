<?php

namespace SisServicios\Http\Controllers;

use SisServicios\Condiciones;
use Illuminate\Http\Request;

use SisServicios\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use SisServicios\Http\Requests\TipoPersonaFormRequest;
use DB;

class CondicionesController extends Controller
{
public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $Tipo_Persona=DB::table('Tipo_Persona')
            ->where('descripcion','like','%'.$query.'%')
            ->where('estado','=',1)
            ->orderby('codigo_tipo_persona','desc')
            ->paginate(5);    
            return view('Mantenimientos.Tipopersona.index',["Tipo_Persona"=>$Tipo_Persona,"searchText"=>$query]);
        }
    }

    public function create()
    {
        return view("Mantenimientos.Tipopersona.create");
    }

    public function store(TipoPersonaFormRequest $request)
    {
        $Tipopersona=new TipoPersona;
        $Tipopersona->descripcion=$request->get('descripcion');
        $Tipopersona->estado=(1);
        $Tipopersona->save();

        return redirect::to('Mantenimientos\Tipopersona');
    }

    public function show($id)
    {
        return view("Mantenimientos.Tipopersona.show",["Tipo_Persona"=>TipoPersona::findOrFail($id)]);
    }

    public function edit($id)
    {
        return view("Mantenimientos.Tipopersona.edit",["Tipo_Persona"=>TipoPersona::findOrFail($id)]);
    }

    public function update(TipoPersonaFormRequest $request,$id)
    {
        $tipopersona=TipoPersona::findorfail($id);
        $tipopersona->descripcion=$request->get('descripcion');
        $tipopersona->update();
        return redirect::to('Mantenimientos\Tipopersona');
    }

    public function destroy($id)
    {
        $tipopersona=TipoPersona::findorfail($id);
        $tipopersona->estado=(0);
        $tipopersona->update();
        return redirect::to('Mantenimientos\Tipopersona');
    }
}
