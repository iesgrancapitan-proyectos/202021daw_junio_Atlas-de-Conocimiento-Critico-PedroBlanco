<?php

namespace App\Http\Controllers;

use App\Models\Ambito;
use Illuminate\Http\Request;

class AmbitoController extends Controller
{
    /**
     * Mostramos todos los elementos existentes en el almacenamiento
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Primero, recuperamos los datos de la BD
        $ambitos = Ambito::latest()->get();

        // Segundo, pasamos los datos a la plantilla correspondiente
        //return view ('ambito.list', compact('ambitos')); // Forma compacta
        return view ('ambito.list')->with([
            'ambitos' => $ambitos,
            'titulo_pagina' => 'Gestionar &Aacute;mbitos'
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
        return view ('ambito.create')->with([
            'titulo_pagina' => 'Crear &Aacute;mbito'
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
        $ambito = Ambito::create($request->all());

        //return view('ambito');
        return redirect()->back();
    }

    /**
     * Mostramos un elemento particular
     *
     * @param  \App\Models\Ambito  $ambito
     * @return \Illuminate\Http\Response
     */
    public function show(Ambito $ambito)
    {
        return view ('ambito.show')->with([
            'ambito' => $ambito,
            'titulo_pagina' => 'Mostrar &Aacute;mbito'
            ]);
    }

    /**
     * Cargamos los datos de un elemento para editar y mostramos el formulario
     *
     * @param  \App\Models\Ambito  $ambito
     * @return \Illuminate\Http\Response
     */
    public function edit(Ambito $ambito)
    {
        return view ('ambito.edit')->with([
            'ambito' => $ambito,
            'titulo_pagina' => 'Editar &Aacute;mbito'
        ]);
    }

    /**
     * Guardamos los datos de un elemento editado/actualizado
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ambito  $ambito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ambito $ambito)
    {
        // Primero, validamos
        $this->validate($request, [
            'nombre' => 'required',
            'descripcion' => 'required'
        ]);
        // Segundo, almacenamos en la BD
        $ambito->update($request->all());

        return redirect()->route('ambito.index');
    }

    /**
     * Eliminamos un elemento en particular del almacenamiento
     *
     * @param  \App\Models\Ambito  $ambito
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ambito $ambito)
    {
        $ambito->delete();

        return redirect()->route('ambito.index');
    }
}
