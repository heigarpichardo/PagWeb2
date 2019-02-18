<?php

namespace SisServicios\Http\Controllers;

use SisServicios\Condiciones;
use Illuminate\Http\Request;

class CondicionesController extends Controller
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
        return view("Mantenimientos.Condiciones.create");
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
     * @param  \SisServicios\Condiciones  $condiciones
     * @return \Illuminate\Http\Response
     */
    public function show(Condiciones $condiciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SisServicios\Condiciones  $condiciones
     * @return \Illuminate\Http\Response
     */
    public function edit(Condiciones $condiciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \SisServicios\Condiciones  $condiciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Condiciones $condiciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SisServicios\Condiciones  $condiciones
     * @return \Illuminate\Http\Response
     */
    public function destroy(Condiciones $condiciones)
    {
        //
    }
}
