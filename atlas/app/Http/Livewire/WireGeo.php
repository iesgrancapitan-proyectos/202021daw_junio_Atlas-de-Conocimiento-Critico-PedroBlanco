<?php

namespace App\Http\Livewire;

use App\Models\Geo;
use Livewire\Component;

use Illuminate\Http\Request;
use App\Http\Traits\InlineSearch;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class WireGeo extends Component
{
    use AuthorizesRequests;
    use InlineSearch;

    public $nombre, $dir3, $_id;
    public $isOpen = 0;

    protected $listeners = [ 'App\Models\Geo_inline_search' => 'render' ];

    public $mensajes = array(
        'titulo_pagina' => 'Gestión de Localizaciones Geográficas',
        'boton_crear' => 'Crear nueva Localización Geográfica'
    );

    protected $rules = [
        'nombre' => 'required',
        'dir3' => 'nullable|size:9|starts_with:E,A,L,U,I,J',
//        'longitud' => 'nullable|numeric',
//        'latitud' => 'nullable|numeric',
];


public function mount (Request $request)
{
    $this->model = 'App\Models\Geo';

    if ( $request->get('query') ) {
        $this->initial_query = $request->get('query');
        $this->query = $this->initial_query;
        Log::debug($this->model.'->mount() | query = '.$request->get('query') );
    } else {
        Log::debug($this->model.'->mount() | query vacía' );
    }

}

public function render()
{
    Log::debug($this->model.'->render() | initial_query: '.$this->initial_query );
    Log::debug($this->model.'->render() | query:'.$this->query );
    $this->authorize('viewAny', Geo::class);

    if ( $this->query != '' ) {
        $this->contenedor = $this->inline_search ();
    } else {
        $this->contenedor = Geo::latest()->get();
    }

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
        if ( ! empty ( $this->_id ) ) {
            $this->authorize('update', Geo::findOrFail($this->_id));
        } else {
            $this->authorize('create', Geo::class);
        }

        $this->validate([
            'nombre' => 'required',
            'dir3' => 'nullable|size:9|starts_with:E,A,L,U,I,J',
            // 'longitud' => 'nullable|numeric',
            // 'latitud' => 'nullable|numeric',
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

