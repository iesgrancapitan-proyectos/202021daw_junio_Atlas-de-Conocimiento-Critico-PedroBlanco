<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Http\Request;
use App\Models\Administracion;
use App\Http\Traits\InlineSearch;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class WireAdministracion extends Component
{
    use AuthorizesRequests;
    use InlineSearch;

    public $nombre, $descripcion, $_id;
    public $isOpen = 0;

    protected $listeners = [ 'App\Models\Administracion_inline_search' => 'render' ];

    public $mensajes = array(
        'titulo_pagina' => 'Gestión de Administraciones',
        'boton_crear' => 'Crear nueva Administración'
    );

    public function mount (Request $request)
    {
        $this->model = 'App\Models\Administracion';

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
        $this->authorize('viewAny', Administracion::class);

        if ( $this->query != '' ) {
            $this->contenedor = $this->inline_search ();
        } else {
            $this->contenedor = Administracion::latest()->get();
        }

        return view('livewire.generic.list');
    }

    public function create()
    {
        $this->authorize('create', Administracion::class);

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
            $this->authorize('update', Administracion::findOrFail($this->_id));
        } else {
            $this->authorize('create', Administracion::class);
        }

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

        $this->authorize('update', $administracion);

        $this->_id = $id;
        $this->nombre = $administracion->nombre;
        $this->descripcion = $administracion->descripcion;

        $this->openModal();
    }

    public function delete($id)
    {
        $administracion = Administracion::find($id);

        $this->authorize('delete', $administracion);

        $administracion->delete();
        session()->flash('message', 'Administración borrada correctamente.');
    }
}

