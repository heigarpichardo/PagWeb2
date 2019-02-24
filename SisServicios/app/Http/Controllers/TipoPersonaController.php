<?php

namespace SisServicios\Http\Controllers;

use SisServicios\TipoPersona;
use Illuminate\Http\Request;

use SisServicios\Http\Requests;
//use SisServicios\Ciudad;
use Illuminate\Support\Facades\Redirect;
use SisServicios\Http\Requests\TipoPersonaFormRequest;
use DB;

class TipoPersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $Tipo_Persona=DB::table('Tipo_Persona')
            ->where('descripcion','like','%'.$query.'%')
            ->orderby('codigo_tipo_persona','desc')
            ->paginate(5);    
            return view('Mantenimientos.Tipopersona.index',["Tipo_Persona"=>$Tipo_Persona,"searchText"=>$query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Mantenimientos.Tipopersona.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoPersonaFormRequest $request)
    {
        $Tipopersona=new TipoPersona;
        $Tipopersona->descripcion=$request->get('descripcion');
        $Tipopersona->estado=(1);
        $Tipopersona->save();

        return redirect::to('Mantenimientos\Tipopersona');
    }

    /**
     * Display the specified resource.
     *
     * @param  \SisServicios\TipoPersona  $tipoPersona
     * @return \Illuminate\Http\Response
     */
    public function show(TipoPersona $tipoPersona)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SisServicios\TipoPersona  $tipoPersona
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoPersona $tipoPersona)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \SisServicios\TipoPersona  $tipoPersona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoPersona $tipoPersona)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SisServicios\TipoPersona  $tipoPersona
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoPersona $tipoPersona)
    {
        //
    }
}
