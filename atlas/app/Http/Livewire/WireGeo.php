<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Geo;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class WireGeo extends Component
{
    use AuthorizesRequests;

    public $contenedor;
    public $nombre, $dir3, $_id;
    public $isOpen = 0;

    public $mensajes = array(
        'titulo_pagina' => 'Gestión de Localizaciones Geográficas',
        'boton_crear' => 'Crear nueva Localización Geográfica'
    );

    protected $rules = [
        'nombre' => 'required',
        'dir3' => 'sometimes|size:9|starts_with:E,A,L,U,I,J',
//        'longitud' => 'sometimes|numeric',
//        'latitud' => 'sometimes|numeric',
];


    public function render()
    {
        $this->contenedor = Geo::latest()->get();;

        return view('livewire.wire-geo');
    }

    public function create()
    {
        $this->authorize('create', Geo::class);

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
        if ( $this->_id !== null ) {
            $this->authorize('update', Geo::findOrFail($this->_id));
        } else {
            $this->authorize('create', Geo::class);
        }

        $this->validate([
            'nombre' => 'required',
            'dir3' => 'size:9|starts_with:E,A,L,U,I,J',
            // 'longitud' => 'numeric',
            // 'latitud' => 'numeric',
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

        $this->authorize ('update', $geo);

        $this->_id = $id;
        $this->nombre = $geo->nombre;
        $this->dir3 = $geo->dir3;

        $this->openModal();
    }

    public function delete($id)
    {
        $geo = Geo::find($id);

        $this->authorize ('delete', $geo);

        $geo->delete();
        session()->flash('message', 'Localización Geográfica borrada correctamente.');
    }
}

