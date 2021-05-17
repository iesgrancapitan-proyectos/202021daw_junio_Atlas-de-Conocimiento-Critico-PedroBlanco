<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    /**
     * Mostramos todos los elementos existentes en el almacenamiento
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Primero, recuperamos los datos de la BD
        $autores = Autor::latest()->get();

        // Segundo, pasamos los datos a la plantilla correspondiente
        //return view ('autor.list', compact('autores')); // Forma compacta
        return view ('autor.list')->with([
            'autores' => $autores,
            'titulo_pagina' => 'Gestionar Autores'
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
        return view ('autor.create')->with([
            'titulo_pagina' => 'Crear Autor'
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
            'apellidos' => 'required',
            'url' => 'required'
        ]);
        // Segundo, almacenamos en la BD
        $autor = Autor::create($request->all());

        //return view('autor');
        return redirect()->back();
    }

    /**
     * Mostramos un elemento particular
     *
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function show(Autor $autor)
    {
        return view ('autor.show')->with([
            'autor' => $autor,
            'titulo_pagina' => 'Mostrar Autor'
            ]);
    }

    /**
     * Cargamos los datos de un elemento para editar y mostramos el formulario
     *
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function edit(Autor $autor)
    {
        return view ('autor.edit')->with([
            'autor' => $autor,
            'titulo_pagina' => 'Editar Autor'
        ]);
    }

    /**
     * Guardamos los datos de un elemento editado/actualizado
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Autor $autor)
    {
        // Primero, validamos
        $this->validate($request, [
            'nombre' => 'required',
            'apellidos' => 'required',
            'url' => 'required'
        ]);
        // Segundo, almacenamos en la BD
        $autor->update($request->all());

        return redirect()->route('autor.index');
    }

    /**
     * Eliminamos un elemento en particular del almacenamiento
     *
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Autor $autor)
    {
        $autor->delete();

        return redirect()->route('autor.index');
    }
}
