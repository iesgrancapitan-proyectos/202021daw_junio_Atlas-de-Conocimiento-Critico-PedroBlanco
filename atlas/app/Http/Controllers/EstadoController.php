<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    /**
     * Mostramos todos los elementos existentes en el almacenamiento
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Primero, recuperamos los datos de la BD
        $estados = Estado::latest()->get();

        // Segundo, pasamos los datos a la plantilla correspondiente
        //return view ('estado.list', compact('estados')); // Forma compacta
        return view ('estado.list')->with([
            'estados' => $estados,
            'titulo_pagina' => 'Gestionar Estados'
            ]); // Mediante método
    }

    /**
     * Cargamos los datos de un elemento para editar y mostramos el formulario
     * FIXME: ¿Estamos usando este método?
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('estado.create')->with([
            'titulo_pagina' => 'Crear Estado'
        ]);
    }

    /**
     * Almacenamos un elemento
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Primero, validamos
        $this->validate($request, [
            'nombre' => 'required',
            'descripcion' => 'required'
        ]);
        // Segundo, almacenamos en la BD
        $estado = Estado::create($request->all());

        //return view('estado');
        return redirect()->back();
    }

    /**
     * Mostramos un elemento particular
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function show(Estado $estado)
    {
        return view ('estado.show')->with([
            'estado' => $estado,
            'titulo_pagina' => 'Mostrar Estado'
            ]);
    }

    /**
     * Cargamos los datos de un elemento para editar y mostramos el formulario
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function edit(Estado $estado)
    {
        return view ('estado.edit')->with([
            'estado' => $estado,
            'titulo_pagina' => 'Editar Estado'
        ]);
    }

    /**
     * Guardamos los datos de un elemento editado/actualizado
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estado $estado)
    {
        // Primero, validamos
        $this->validate($request, [
            'nombre' => 'required',
            'descripcion' => 'required'
        ]);
        // Segundo, almacenamos en la BD
        $estado->update($request->all());

        return redirect()->route('estado.index');
    }

    /**
     * Eliminamos un elemento en particular del almacenamiento
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estado $estado)
    {
        $estado->delete();

        return redirect()->route('estado.index');
    }
}
