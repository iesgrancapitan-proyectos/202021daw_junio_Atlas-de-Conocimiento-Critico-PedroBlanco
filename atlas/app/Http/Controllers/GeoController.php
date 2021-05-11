<?php

namespace App\Http\Controllers;

use App\Models\Geo;
use Illuminate\Http\Request;

class GeoController extends Controller
{
    /**
     * Mostramos todos los elementos existentes en el almacenamiento
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Primero, recuperamos los datos de la BD
        $geos = Geo::latest()->get();

        // Segundo, pasamos los datos a la plantilla correspondiente
        //return view ('geo.list', compact('geos')); // Forma compacta
        return view ('geo.list')->with([
            'geos' => $geos,
            'titulo_pagina' => 'Gestionar Localizaciones Geográficas'
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
        return view ('geo.create')->with([
            'titulo_pagina' => 'Crear Localización Geográfica'
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
            'dir3' => 'required'
        ]);
        // Segundo, almacenamos en la BD
        $geo = Geo::create($request->all());

        //return view('geo');
        return redirect()->back();
    }

    /**
     * Mostramos un elemento particular
     *
     * @param  \App\Models\Geo  $geo
     * @return \Illuminate\Http\Response
     */
    public function show(Geo $geo)
    {
        return view ('geo.show')->with([
            'geo' => $geo,
            'titulo_pagina' => 'Mostrar Localización Geográfica'
            ]);
    }

    /**
     * Cargamos los datos de un elemento para editar y mostramos el formulario
     *
     * @param  \App\Models\Geo  $geo
     * @return \Illuminate\Http\Response
     */
    public function edit(Geo $geo)
    {
        return view ('geo.edit')->with([
            'geo' => $geo,
            'titulo_pagina' => 'Editar Localización Geográfica'
        ]);
    }

    /**
     * Guardamos los datos de un elemento editado/actualizado
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Geo  $geo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Geo $geo)
    {
        // Primero, validamos
        $this->validate($request, [
            'nombre' => 'required',
            'dir3' => 'required'
        ]);
        // Segundo, almacenamos en la BD
        $geo->update($request->all());

        return redirect()->route('geo.index');
    }

    /**
     * Eliminamos un elemento en particular del almacenamiento
     *
     * @param  \App\Models\Geo  $geo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Geo $geo)
    {
        $geo->delete();

        return redirect()->route('geo.index');
    }
}
