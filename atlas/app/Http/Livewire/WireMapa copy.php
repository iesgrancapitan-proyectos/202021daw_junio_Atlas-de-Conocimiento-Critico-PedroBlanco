<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Mapa;
use App\Models\Administracion;
use App\Models\Ambito;
use App\Models\Estado;
use App\Models\Autor;
use App\Models\Geo;

use Illuminate\Support\Collection;

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

            // Arrays con las listas de los ids de todos los autores y geos
    public  $autores_id,
            $geos_id;

            // Arrays con las lista de los ids de los autores y geos del mapa
    public  $select_autores_id,
            $select_geos_id;

            // Colecciones con todos los elementos
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


        $this->select_autores_id = array ();
        $this->select_geos_id = array ();

        $this->administraciones = Administracion::latest()->get();
        $this->estados = Estado::latest()->get();
        $this->ambitos = Ambito::latest()->get();
        $this->autores = Autor::latest()->get();
        $this->geos = Geo::latest()->get();

        // $this->autores_id = collect ();
        // $this->geos_id = collect ();
        $this->autores_id = $this->autores->all();
        $this->geos_id = $this->geos->all();
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
            // Habrá que activar la validación en otro sitio?
            // FIXME: Comprobar si funciona aquí o no
            // 'autores_id' => 'required|array|min:1',
            // 'geos_id' => 'required|array|min:1',
            'autores_id.*' => 'required',
            'geos_id.*' => 'required',
            'select_autores_id.*' => 'required',
            'select_geos_id.*' => 'required',
        ]);

        // dd($this->select_autores_id);
        // dd($this->select_geos_id);

        $_temp_autores = Array();
        foreach ($this->select_autores_id as $key => $value) {
            $_temp_autores[] = $value;
        }
        // dd($_temp_autores);
        dd( $this->autores->whereIn('id', ['2', '1']) );
        $_temp_autores = $this->autores->whereIn('id', $this->select_autores_id )->get();

        $_temp_geos = Array();
        foreach ($this->select_geos_id as $key => $value) {
            $_temp_geos[] = $value;
        }
        $_temp_geos = $this->geos->whereIn('id', $this->select_autores_id )->get();

        // dd($this->select_autores_id);
        // dd($this->select_geos_id);

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

        // $temp_mapa->autores()->sync($this->autores_id);
        // $temp_mapa->geo()->sync($this->geos_id);

        // $temp_mapa->autores()->sync($this->select_autores_id);
        // $temp_mapa->geo()->sync($this->select_geos_id);
        $temp_mapa->autores()->sync($this->$_temp_autores);
        $temp_mapa->geo()->sync($this->$_temp_geos);


        foreach ($this->temp as $key => $value) {
            # code...
        }


        session()->flash('message',
            $this->_id ? 'Mapa actualizado correctamente.' : 'Mapa creado correctamente.');

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
        $this->f_creacion = $mapa->f_creacion->format('Y-m-d');
        $this->f_actualizado = $mapa->f_actualizado->format('Y-m-d');
        // $this->administracion_id = $mapa->administracion_id;
        // $this->ambito_id = $mapa->ambito_id;
        // $this->estado_id = $mapa->estado_id;
        $this->administracion_id = $mapa->administracion->id;
        $this->ambito_id = $mapa->ambito->id;
        $this->estado_id = $mapa->estado->id;

        $this->select_autores_id = array();
        $this->select_geos_id = array();

        $this->administraciones = Administracion::latest()->get();
        $this->estados = Estado::latest()->get();
        $this->ambitos = Ambito::latest()->get();
        $this->autores = Autor::latest()->get();
        $this->geos = Geo::latest()->get();
        $this->autores_id = $this->autores->all();
        $this->geos_id = $this->geos->all();

        // dd ( $this->autores_id );

        $mapa->autores->each(function ($_autor) {
            $this->select_autores_id[] = $_autor->id;
        });

        $mapa->geo->each(function ($_geo) {
            $this->select_geos_id[] = $_geo->id;
        });

        // dd($mapa->geo);

        // $this->select_autores_id = $mapa->autores->all();
        // $this->select_geos_id = $mapa->geo->all;
        // $this->select_autores_id = $mapa->autores->toArray();
        // $this->select_geos_id = $mapa->geo->toArray();
        // $this->autores_id = $mapa->autores();
        // $this->geos_id = $mapa->geo();

        // dd( $this->select_autores_id );
        // dd( $this->select_geos_id );

        $this->administraciones = Administracion::latest()->get();
        $this->estados = Estado::latest()->get();
        $this->ambitos = Ambito::latest()->get();
        $this->autores = Autor::latest()->get();
        $this->geos = Geo::latest()->get();

        $this->openModal();
    }

    public function delete($id)
    {
        Mapa::find($id)->geo()-
        Mapa::find($id)->delete();
        session()->flash('message', 'Mapa borrado correctamente.');
    }
}
