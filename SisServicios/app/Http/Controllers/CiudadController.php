<?php

namespace SisServicios\Http\Controllers;

use Illuminate\Http\Request;

use SisServicios\Http\Requests;
use SisServicios\Ciudad;
use Illuminate\Support\Facades\Redirect;
use SisServicios\Http\Requests\CiudadFormRequest;
use DB;

class CiudadController extends Controller
{
    public function _contructor()
    {

    }
    public function index(Request $request)
    {
    	if ($request)
    	{
    		$query=trim($request->get('searchText'));
    		$ciudades=DB::table('ciudad')
            ->where('ciudad','like','%'.$query.'%')
            ->orderby('id_ciudad','desc')
            ->paginate(5);    
    		return view('direccion.ciudades.index',["ciudades"=>$ciudades,"searchText"=>$query]);
    	}
    }

    public function create()
    {
    	return view("direccion.ciudades.create");
    }
    public function store(CiudadFormRequest $request)
    {
    	$ciudad=new ciudad;
    	$ciudad->ciudad=$request->get('ciudad');
    	$ciudad->save();

    	return redirect::to('direccion\ciudades');
    }
    public function show($id)
    {
    	return view("direccion.ciudades.show",["ciudad"=>ciudad::findOrFail($id)]);
    }
    public function edit($id)
    {
    	return view("direccion.ciudades.edit",["ciudad"=>ciudad::findOrFail($id)]);
    }
    public function update(CiudadFormRequest $request,$id)
    {
    	$ciudad=ciudad::findorfail($id);
    	$ciudad->ciudad=$request->get('ciudad');
    	$ciudad->update();
    	return redirect::to('direccion\ciudades');
    }
    public function destroy($id)
    {
    	return redirect::to('direccion\ciudades');
    }
}
