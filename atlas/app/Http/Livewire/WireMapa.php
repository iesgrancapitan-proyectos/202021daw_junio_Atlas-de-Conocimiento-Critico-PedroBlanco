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

    protected $rules = [
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
        // 'autores_id' => 'required',
        // 'geos_id' => 'required',
        'autores_id.*' => 'required',
        'geos_id.*' => 'required',
        'autores' => 'required',
        'geos' => 'required',
    ];

    public function render()
    {
        $this->contenedor = Mapa::latest()->get();;

        return view('livewire.wire-mapa');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->emitTo ( 'livewire.mapa.create', 'mount', null );
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
        $this->_id = null;

        $this->autores_id = Array();
        $this->geos_id = Array();

        $this->administraciones = Administracion::latest()->get();
        $this->estados = Estado::latest()->get();
        $this->ambitos = Ambito::latest()->get();
        $this->autores = Autor::latest()->get();
        $this->geos = Geo::latest()->get();
    }

    public function store()
    {
        dd($this);
        // dd($this->autores);
        // dd($this->geos);
        // dd($this->autores_id);
        // dd(array_keys($this->autores_id));
        // dd(array_keys($this->selected_autores_id));

        $this->validate();

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

        $temp_mapa->autores()->sync(array_keys($this->autores_id));
        $temp_mapa->geo()->sync(array_keys($this->geos_id));

        // $temp_mapa->autores()->sync($this->autores);
        // $temp_mapa->geo()->sync($this->geos);


        session()->flash('message',
            $this->_id ? 'Mapa actualizado correctamente.' : 'Mapa creado correctamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        //$this->emitTo ( 'livewire.mapa.create', 'mount', $id );

        $mapa = Mapa::findOrFail($id);
        $this->_id = $id;
        $this->nombre = $mapa->nombre;
        $this->descripcion = $mapa->descripcion;
        $this->url = $mapa->url;
        $this->comentario = $mapa->comentario;
        $this->f_creacion = $mapa->f_creacion->format('Y-m-d');
        $this->f_actualizado = $mapa->f_actualizado->format('Y-m-d');
        $this->administracion_id = $mapa->administracion_id;
        $this->ambito_id = $mapa->ambito_id;
        $this->estado_id = $mapa->estado_id;

        // Guardamos los ids de los autores y los geos conectados al mapa actual en un array
        $this->autores_id = array_flip ( $mapa->autores()->get()->pluck('id')->toArray() );
        $this->geos_id = array_flip ( $mapa->geo()->get()->pluck('id')->toArray() );

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

    public function mount()
    {

    }
}
