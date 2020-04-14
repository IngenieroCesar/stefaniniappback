<?php

namespace App\Http\Controllers;

use App\WorkPosition;
use Illuminate\Http\Request;

class WorkPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Devolvemos la colección de datos para WorkPositions
        $workposition = WorkPosition::all();
        return $workposition;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Resivimos los datos enviados mediante POST, y creamos nuestro objeto
        //En este punto hace falta hacer validación de todos los campos
        //O en este aso crearemos datos default para evitar errores
        $workposition = WorkPosition::create($request->all());
        return $workposition;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WorkPosition  $workPosition
     * @return \Illuminate\Http\Response
     */
    public function show(WorkPosition $workPosition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WorkPosition  $workPosition
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkPosition $workPosition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WorkPosition  $workPosition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkPosition $workPosition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WorkPosition  $workPosition
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkPosition $workPosition)
    {
        //
    }
}
