<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Geo;

class WireGeo extends Component
{
    public $contenedor;
    public $nombre, $dir3, $_id;
    public $isOpen = 0;

    public $mensajes = array(
        'titulo_pagina' => 'Gestión de Localizaciones Geográficas',
        'boton_crear' => 'Crear nueva Localización Geográfica'
    );

    public function render()
    {
        $this->contenedor = Geo::latest()->get();;

        return view('livewire.wire-geo');
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
        $this->dir3 = '';
        $this->_id = '';
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required',
            'dir3' => 'required',
        ]);

        Geo::updateOrCreate(['id' => $this->_id], [
            'nombre' => $this->nombre,
            'dir3' => $this->dir3
        ]);

        session()->flash('message',
            $this->_id ? 'Localización Geográfica definida correctamente.' : 'Localización Geográfica actualizada correctamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $geo = Geo::findOrFail($id);
        $this->_id = $id;
        $this->nombre = $geo->nombre;
        $this->dir3 = $geo->dir3;

        $this->openModal();
    }

    public function delete($id)
    {
        Geo::find($id)->delete();
        session()->flash('message', 'Localización Geográfica borrada correctamente.');
    }
}

