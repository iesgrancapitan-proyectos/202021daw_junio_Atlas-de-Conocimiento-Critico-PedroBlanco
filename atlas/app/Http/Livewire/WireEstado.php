<?php

namespace App\Http\Livewire;

use App\Models\Estado;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Http\Traits\InlineSearch;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class WireEstado extends Component
{
    use AuthorizesRequests;
    use InlineSearch;

    public $nombre, $descripcion, $_id;
    public $isOpen = 0;

    protected $listeners = [ 'App\Models\Administracion_inline_search' => 'render' ];

    public $mensajes = array(
        'titulo_pagina' => 'Gestión de Estados',
        'boton_crear' => 'Crear nuevo Estado'
    );

    public function mount (Request $request)
    {
        $this->model = 'App\Models\Estado';

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
        $this->authorize('viewAny', Estado::class);

        if ( $this->query != '' ) {
            $this->contenedor = $this->inline_search ();
        } else {
            $this->contenedor = Estado::latest()->get();
        }

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
        if ( ! empty ( $this->_id ) ) {
            $this->authorize('update', Estado::findOrFail($this->_id));
        } else {
            $this->authorize('create', Estado::class);
        }

        $this->validate([
            'nombre' => 'required',
            'descripcion' => 'nullable',
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
