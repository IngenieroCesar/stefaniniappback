<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\WorkPosition;
//Generamos nuestro propio request para el modelo, de tal manera que
//validamos los campos desde el servidor
use App\Http\Requests\Position as PositionRequest;

class WorkPositionController extends Controller
{
    //Creamos nuestro metodo constructor para reasignar a nuestra entidad
    protected $workposition;
    public function __construct( WorkPosition $workposition )
    {
        $this->workposition = $workposition;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //returnamos los objetos
        return response()->json($this->workposition->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PositionRequest $request)
    {
        //Ya que tenemos reasignada nuestra entidad podemos usar sus propiedades.
        $workposition = $this->workposition->create($request->all());
        //Estamos verificando el json, y ademas respondemos con un codigo de inserción 201
        return response()->json($workposition, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WorkPosition  $workPosition
     * @return \Illuminate\Http\Response
     */
    public function show(WorkPosition $workposition)
    {
        //En caso de no encontrar el el objeto, nos arrojara un 404.
        return response()->json($workposition);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WorkPosition  $workPosition
     * @return \Illuminate\Http\Response
     */
    public function update(PositionRequest $request, WorkPosition $workposition)
    {
        //De igual forma que en store, validamos con nuestro request personalizado
        $workposition->update($request->all());

        return response()->json($workposition);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WorkPosition  $workPosition
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkPosition $workposition)
    {
        //Eliminamos el post
        $workposition->delete();
        //Respondemos con un null, y un http 204
        return response()->json(null, 204);
    }
}
