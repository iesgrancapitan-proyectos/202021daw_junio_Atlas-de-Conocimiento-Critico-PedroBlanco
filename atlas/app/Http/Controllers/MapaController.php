<?php

namespace App\Http\Controllers;

use App\Models\Mapa;
use App\Models\Administracion;
use App\Models\Ambito;
use App\Models\Estado;
use App\Models\Autor;
use App\Models\Autor_Mapa;
use App\Models\Geo;
use App\Models\Geo_Mapa;
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
        $administraciones = Administracion::latest()->get();
        $estados = Estado::latest()->get();
        $ambitos = Ambito::latest()->get();
        $autores = Autor::latest()->get();
        $geos = Geo::latest()->get();

        // Segundo, pasamos los datos a la plantilla correspondiente
        //return view ('mapa.list', compact('mapas')); // Forma compacta
        return view ('mapa.list')->with([
            'mapas' => $mapas,
            'administraciones' => $administraciones,
            'estados' => $estados,
            'ambitos' => $ambitos,
            'autores' => $autores,
            'geos' => $geos,
            'titulo_pagina' => 'Gestionar Mapas'
            ]); // Mediante método
    }

    /**
     * Cargamos los datos de necesarios para crear un elemento y mostramos el formulario
     * Nos viene bien para mostrar un elemento desde su propia vista
     * FIXME: ¿Estamos usando este método?
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Primero, recuperamos los datos de la BD
        $administraciones = Administracion::latest()->get();
        $estados = Estado::latest()->get();
        $ambitos = Ambito::latest()->get();
        $autores = Autor::latest()->get();
        $geos = Geo::latest()->get();

        // Segundo, pasamos los datos a la plantilla correspondiente
        return view ('mapa.create')->with([
            'administraciones' => $administraciones,
            'estados' => $estados,
            'ambitos' => $ambitos,
            'autores' => $autores,
            'geos' => $geos,
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
            'descripcion' => 'required',
            'comentario' => 'required',
            'url' => 'required',
            'administraciones' => 'required',
            'estados' => 'required',
            'ambitos' => 'required',
            'autores' => 'required',
            'geos' => 'required',
            'f_creacion' => 'required',
            'f_actualizado' => 'required',
        ]);

        // dd($request->all());

        $temp_mapa = $request->all();

        $temp_mapa['administracion_id'] = $temp_mapa['administraciones'];
        $temp_mapa['estado_id'] = $temp_mapa['estados'];
        $temp_mapa['ambito_id'] = $temp_mapa['ambitos'];

        // Segundo, almacenamos en la BD
        $mapa = Mapa::create($temp_mapa);

        // FIXME: Asociar el mapa a su autor (N:M)
        $mapa->autores()->attach($temp_mapa['autores']);
        // FIXME: Asociar el mapa a su geo (N:M)
        $mapa->geo()->attach($temp_mapa['geos']);

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
