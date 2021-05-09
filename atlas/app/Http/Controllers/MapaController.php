<?php

namespace App\Http\Controllers;

use App\Models\Mapa;
use Illuminate\Http\Request;

class MapaController extends Controller
{
    /**
     * Mostramos todos los elementos existentes en el almacenamiento
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Primero, recuperamos los datos de la BD
        $mapas = Mapa::latest()->get();

        // Segundo, pasamos los datos a la plantilla correspondiente
        //return view ('mapa.list', compact('mapas')); // Forma compacta
        return view ('mapa.list')->with([
            'mapas' => $mapas,
            'titulo_pagina' => 'Gestionar Mapas'
            ]); // Mediante método
    }

    /**
     * Cargamos los datos de un elemento para editar y mostramos el formulario
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('mapa.create')->with([
            'titulo_pagina' => 'Crear Mapa'
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
        $mapa = Mapa::create($request->all());

        //return view('mapa');
        return redirect()->back();
    }

    /**
     * Mostramos un elemento particular
     *
     * @param  \App\Models\Mapa  $mapa
     * @return \Illuminate\Http\Response
     */
    public function show(Mapa $mapa)
    {
        return view ('mapa.show')->with([
            'mapa' => $mapa,
            'titulo_pagina' => 'Mostrar Mapa'
            ]);
    }

    /**
     * Cargamos los datos de un elemento para editar y mostramos el formulario
     *
     * @param  \App\Models\Mapa  $mapa
     * @return \Illuminate\Http\Response
     */
    public function edit(Mapa $mapa)
    {
        return view ('mapa.edit')->with([
            'mapa' => $mapa,
            'titulo_pagina' => 'Editar Mapa'
        ]);
    }

    /**
     * Guardamos los datos de un elemento editado/actualizado
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mapa  $mapa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mapa $mapa)
    {
        // Primero, validamos
        $this->validate($request, [
            'nombre' => 'required',
            'descripcion' => 'required'
        ]);
        // Segundo, almacenamos en la BD
        $mapa->update($request->all());

        return redirect()->route('mapa.index');
    }

    /**
     * Eliminamos un elemento en particular del almacenamiento
     *
     * @param  \App\Models\Mapa  $mapa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mapa $mapa)
    {
        $mapa->delete();

        return redirect()->route('mapa.index');
    }
}
