<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Estado;

class WireEstado extends Component
{
    public $contenedor;
    public $nombre, $descripcion, $_id;
    public $isOpen = 0;

    public $mensajes = array(
        'titulo_pagina' => 'Gestión de Estados',
        'boton_crear' => 'Crear nuevo Estado'
    );

    public function render()
    {
        $this->contenedor = Estado::latest()->get();;

        // return view('livewire.wire-estado');
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

        Estado::updateOrCreate(['id' => $this->_id], [
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion
        ]);

        session()->flash('message',
            $this->_id ? 'Estado definido correctamente.' : 'Estado actualizado correctamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $estado = Estado::findOrFail($id);
        $this->_id = $id;
        $this->nombre = $estado->nombre;
        $this->descripcion = $estado->descripcion;

        $this->openModal();
    }

    public function delete($id)
    {
        Estado::find($id)->delete();
        session()->flash('message', 'Estado borrado correctamente.');
    }
}
