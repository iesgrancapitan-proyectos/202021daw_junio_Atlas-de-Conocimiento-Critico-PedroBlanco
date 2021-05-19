<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Mapa;
use App\Models\Administracion;
use App\Models\Ambito;
use App\Models\Estado;
use App\Models\Autor;
use App\Models\Geo;


class WireMapa extends Component
{
    public $contenedor;
    public  $nombre,
            $descripcion,
            $url,
            $comentario,
            $f_creacion,
            $f_actualizado,
            $administracion_id,
            $ambito_id,
            $estado_id,
            $_id;

    // *** Hay que definir y usar estas dos variables como Colecciones de Autor y Geo...
    public  $autores_id,
            $geos_id;

    public  $administraciones,
            $estados,
            $ambitos,
            $autores,
            $geos;
    public $isOpen = 0;

    public $mensajes = array(
        'titulo_pagina' => 'Gestión de Mapas',
        'boton_crear' => 'Crear nuevo Mapa'
    );

    public function render()
    {
        $this->contenedor = Mapa::latest()->get();;

        return view('livewire.wire-mapa');
        //return view('livewire.generic.list');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields(){
        $this->nombre = '';
        $this->descripcion = '';
        $this->url = '';
        $this->comentario = '';
        $this->f_creacion = '';
        $this->f_actualizado = '';
        $this->administracion_id = '';
        $this->ambito_id = '';
        $this->estado_id = '';
        $this->_id = '';
        $this->autores_id = '';
        $this->geos_id = '';

        $this->administraciones = Administracion::latest()->get();
        $this->estados = Estado::latest()->get();
        $this->ambitos = Ambito::latest()->get();
        $this->autores = Autor::latest()->get();
        $this->geos = Geo::latest()->get();
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'url' => 'required',
            'comentario' => 'required',
            'f_creacion' => 'required',
            'f_actualizado' => 'required',
            'administracion_id' => 'required',
            'ambito_id' => 'required',
            'estado_id' => 'required',
            'autores_id' => 'required',
            'geos_id' => 'required',
        ]);

        $temp_mapa = Mapa::updateOrCreate(['id' => $this->_id], [
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'url' => $this->url,
            'comentario' => $this->comentario,
            'f_creacion' => $this->f_creacion,
            'f_actualizado' => $this->f_actualizado,
            'administracion_id' => $this->administracion_id,
            'ambito_id' => $this->ambito_id,
            'estado_id' => $this->estado_id,
        ]);

        $temp_mapa->autores()->sync($this->autores_id);
        $temp_mapa->geo()->sync($this->geos_id);


        session()->flash('message',
            $this->_id ? 'Mapa definido correctamente.' : 'Mapa actualizado correctamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $mapa = Mapa::findOrFail($id);
        $this->_id = $id;
        $this->nombre = $mapa->nombre;
        $this->descripcion = $mapa->descripcion;
        $this->url = $mapa->url;
        $this->comentario = $mapa->comentario;
        $this->f_creacion = $mapa->f_creacion;
        $this->f_actualizado = $mapa->f_actualizado;
        $this->administracion_id = $mapa->administracion_id;
        $this->ambito_id = $mapa->ambito_id;
        $this->estado_id = $mapa->estado_id;

        $this->autores_id = $mapa->autores;
        $this->geos_id = $mapa->geo;

        $this->administraciones = Administracion::latest()->get();
        $this->estados = Estado::latest()->get();
        $this->ambitos = Ambito::latest()->get();
        $this->autores = Autor::latest()->get();
        $this->geos = Geo::latest()->get();

        $this->openModal();
    }

    public function delete($id)
    {
        Mapa::find($id)->delete();
        session()->flash('message', 'Mapa borrado correctamente.');
    }
}
