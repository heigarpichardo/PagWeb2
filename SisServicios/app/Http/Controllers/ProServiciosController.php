<?php

namespace SisServicios\Http\Controllers;

use SisServicios\ProServicios;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

use SisServicios\Http\Requests;
use SisServicios\Http\Requests\ServiciosFormRequest;

use Carbon\Carbon;
use DB;
//holamundo
class ProServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("Procesos.Servicios.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \SisServicios\ProServicios  $proServicios
     * @return \Illuminate\Http\Response
     */
    public function show(ProServicios $proServicios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SisServicios\ProServicios  $proServicios
     * @return \Illuminate\Http\Response
     */
    public function edit(ProServicios $proServicios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \SisServicios\ProServicios  $proServicios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProServicios $proServicios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SisServicios\ProServicios  $proServicios
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProServicios $proServicios)
    {
        //
    }
}
