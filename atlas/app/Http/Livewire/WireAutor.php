<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Autor;

class WireAutor extends Component
{
    public $contenedor;
    public $nombre, $apellidos, $url, $_id;
    public $isOpen = 0;

    public $mensajes = array(
        'titulo_pagina' => 'Gestión de Autores/as de Mapas',
        'boton_crear' => 'Crear nuevo Autor/a'
    );

    public function render()
    {
        $this->contenedor = Autor::latest()->get();;

        return view('livewire.wire-autor');
        // No podemos usar la vista genérica si no usamos una lista de campos
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
        $this->apellidos = '';
        $this->url = '';
        $this->_id = '';
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'url' => 'required',
        ]);

        Autor::updateOrCreate(['id' => $this->_id], [
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'url' => $this->url,
        ]);

        session()->flash('message',
            $this->_id ? 'Autor/a definido correctamente.' : 'Autor/a actualizado correctamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $autor = Autor::findOrFail($id);
        $this->_id = $id;
        $this->nombre = $autor->nombre;
        $this->apellidos = $autor->apellidos;
        $this->url = $autor->url;

        $this->openModal();
    }

    public function delete($id)
    {
        Autor::find($id)->delete();
        session()->flash('message', 'Autor/a borrado correctamente.');
    }
}

