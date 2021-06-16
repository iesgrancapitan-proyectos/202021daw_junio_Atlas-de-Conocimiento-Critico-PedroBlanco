<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Livewire\Component;
use App\Models\Ambito;

class WireAmbito extends Component
{
    use AuthorizesRequests;

    public $contenedor;
    public $nombre, $descripcion, $_id;
    public $isOpen = 0;
    public $model = App\Models\Ambito::class;

    public $mensajes = array(
        'titulo_pagina' => 'Gestión de Ámbitos',
        'boton_crear' => 'Crear nuevo Ámbito'
    );

    public function render()
    {
        $this->authorize('viewAny', Ambito::class);

        $this->contenedor = Ambito::latest()->get();;

        return view('livewire.generic.list');
    }

    public function create()
    {
        $this->authorize('create', Ambito::class);

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
            $this->authorize('update', Ambito::findOrFail($this->_id));
        } else {
            $this->authorize('create', Ambito::class);
        }

        $this->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);

        Ambito::updateOrCreate(['id' => $this->_id], [
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion
        ]);

        session()->flash('message',
            $this->_id ? 'Ámbito definido correctamente.' : 'Ámbito actualizado correctamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $ambito = Ambito::findOrFail($id);

        $this->authorize('update', $ambito);

        $this->_id = $id;
        $this->nombre = $ambito->nombre;
        $this->descripcion = $ambito->descripcion;

        $this->openModal();
    }

    public function delete($id)
    {
        $ambito = Ambito::find($id);

        $this->authorize('delete', $ambito);

        $ambito->delete();
        session()->flash('message', 'Ámbito borrado correctamente.');
    }
}
