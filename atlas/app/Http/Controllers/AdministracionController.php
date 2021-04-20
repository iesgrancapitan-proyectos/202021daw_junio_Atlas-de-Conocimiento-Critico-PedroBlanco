<?php

namespace App\Http\Controllers;

use App\Models\Administracion;
use Illuminate\Http\Request;

class AdministracionController extends Controller
{
    /**
     * Mostramos todos los elementos existentes en el almacenamiento
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Primero, recuperamos los datos de la BD
        $administraciones = Administracion::latest()->get();

        // Segundo, pasamos los datos a la plantilla correspondiente
        //return view ('administracion.administracion', compact('administraciones')); // Forma compacta
        return view ('administracion.administracion')->with([
            'administraciones' => $administraciones,
            'titulo_pagina' => 'Gestionar Administraciones'
            ]); // Mediante método
    }

    /**
     * Cargamos los datos de un elemento para editar y mostramos el formulario
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('administracion.create')->with([
            'titulo_pagina' => 'Crear Administraci&oacute;n'
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
        $administracion = Administracion::create($request->all());

        //return view('administracion');
        return redirect()->back();
    }

    /**
     * Mostramos un elemento particular
     *
     * @param  \App\Models\Administracion  $administracion
     * @return \Illuminate\Http\Response
     */
    public function show(Administracion $administracion)
    {
        return view ('administracion.show')->with([
            'administracion' => $administracion,
            'titulo_pagina' => 'Mostrar Administraci&oacute;n'
            ]);
    }

    /**
     * Cargamos los datos de un elemento para editar y mostramos el formulario
     *
     * @param  \App\Models\Administracion  $administracion
     * @return \Illuminate\Http\Response
     */
    public function edit(Administracion $administracion)
    {
        return view ('administracion.edit')->with([
            'administracion' => $administracion,
            'titulo_pagina' => 'Editar Administraci&oacute;n'
        ]);
    }

    /**
     * Guardamos los datos de un elemento editado/actualizado
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Administracion  $administracion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Administracion $administracion)
    {
        // Primero, validamos
        $this->validate($request, [
            'nombre' => 'required',
            'descripcion' => 'required'
        ]);
        // Segundo, almacenamos en la BD
        $administracion->update($request->all());

        return redirect()->route('administracion.index');
    }

    /**
     * Eliminamos un elemento en particular del almacenamiento
     *
     * @param  \App\Models\Administracion  $administracion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Administracion $administracion)
    {
        $administracion->delete();

        return redirect()->route('administracion.index');
    }
}
