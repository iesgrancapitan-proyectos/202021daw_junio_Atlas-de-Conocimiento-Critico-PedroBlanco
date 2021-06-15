<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Administracion;

class WireAdministracion extends Component
{
    public $contenedor;
    public $nombre, $descripcion, $_id;
    public $isOpen = 0;

    public $mensajes = array(
        'titulo_pagina' => 'Gestión de Administraciones',
        'boton_crear' => 'Crear nueva Administración'
    );

    public function render()
    {
        $this->contenedor = Administracion::latest()->get();;

        // return view('livewire.wire-administracion');
        return view('livewire.generic.list');
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
        $this->_id = '';
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);

        Administracion::updateOrCreate(['id' => $this->_id], [
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion
        ]);

        session()->flash('message',
            $this->_id ? 'Administración definida correctamente.' : 'Administración actualizada correctamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $administracion = Administracion::findOrFail($id);
        $this->_id = $id;
        $this->nombre = $administracion->nombre;
        $this->descripcion = $administracion->descripcion;

        $this->openModal();
    }

    public function delete($id)
    {
        Administracion::find($id)->delete();
        session()->flash('message', 'Administración borrada correctamente.');
    }
}

