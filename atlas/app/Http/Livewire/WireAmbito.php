<?php

namespace App\Http\Livewire;

use App\Models\Ambito;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Http\Traits\InlineSearch;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class WireAmbito extends Component
{
    use AuthorizesRequests;
    use InlineSearch;

    public $nombre, $descripcion, $_id;
    public $isOpen = 0;

    protected $listeners = [ 'App\Models\Ambito_inline_search' => 'render' ];

    public $mensajes = array(
        'titulo_pagina' => 'Gestión de Ámbitos',
        'boton_crear' => 'Crear nuevo Ámbito'
    );

    public function mount (Request $request)
    {
        $this->model = 'App\Models\Ambito';

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
        $this->authorize('viewAny', Ambito::class);

        if ( $this->query != '' ) {
            $this->contenedor = $this->inline_search ();
        } else {
            $this->contenedor = Ambito::latest()->get();
        }

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
        if ( ! empty ( $this->_id ) ) {
            $this->authorize('update', Ambito::findOrFail($this->_id));
        } else {
            $this->authorize('create', Ambito::class);
        }

        $this->validate([
            'nombre' => 'required',
            'descripcion' => 'nullable',
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
