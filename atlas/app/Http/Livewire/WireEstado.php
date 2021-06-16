<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Livewire\Component;
use App\Models\Estado;

class WireEstado extends Component
{
    use AuthorizesRequests;

    public $contenedor;
    public $nombre, $descripcion, $_id;
    public $isOpen = 0;
    public $model = App\Models\Estado::class;

    public $mensajes = array(
        'titulo_pagina' => 'Gestión de Estados',
        'boton_crear' => 'Crear nuevo Estado'
    );

    public function render()
    {
        $this->authorize('viewAny', Estado::class);

        $this->contenedor = Estado::latest()->get();;

        return view('livewire.generic.list');
    }

    public function create()
    {
        $this->authorize('create', Estado::class);

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
        if ( null !== $this->_id ) {
            $this->authorize('update', Estado::findOrFail($this->_id));
        } else {
            $this->authorize('create', Estado::class);
        }

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

        $this->authorize('update', $estado);

        $this->_id = $id;
        $this->nombre = $estado->nombre;
        $this->descripcion = $estado->descripcion;

        $this->openModal();
    }

    public function delete($id)
    {
        $estado = Estado::find($id);

        $this->authorize('delete', $estado);

        $estado->delete();
        session()->flash('message', 'Estado borrado correctamente.');
    }
}
