<?php

namespace App\Http\Livewire;

use App\Models\Autor;
use Livewire\Component;

use Illuminate\Http\Request;
use App\Http\Traits\InlineSearch;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class WireAutor extends Component
{
    use AuthorizesRequests;
    use InlineSearch;

    public $nombre, $apellidos, $url, $_id;
    public $isOpen = 0;

    protected $listeners = [ 'App\Models\Autor_inline_search' => 'render' ];

    public $mensajes = array(
        'titulo_pagina' => 'Gestión de Autores/as de Mapas',
        'boton_crear' => 'Crear nuevo Autor/a'
    );

    public function mount (Request $request)
    {
        $this->model = 'App\Models\Autor';

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
        $this->authorize('viewAny', Autor::class);

        if ( $this->query != '' ) {
            $this->contenedor = $this->inline_search ();
        } else {
            $this->contenedor = Autor::latest()->get();
        }

        return view('livewire.wire-autor');
    }

    public function create()
    {
        $this->authorize('create', Autor::class);

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
        if ( ! empty ( $this->_id ) ) {
            $this->authorize('update', Autor::findOrFail($this->_id));
        } else {
            $this->authorize('create', Autor::class);
        }

        $this->validate([
            'nombre' => 'required',
            'apellidos' => 'nullable',
            'url' => 'nullable|url',
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

        $this->authorize('update', $autor);

        $this->_id = $id;
        $this->nombre = $autor->nombre;
        $this->apellidos = $autor->apellidos;
        $this->url = $autor->url;

        $this->openModal();
    }

    public function delete($id)
    {
        $autor = Autor::find($id);

        $this->authorize('delete', $autor);

        $autor->delete();
        session()->flash('message', 'Autor/a borrado correctamente.');
    }
}

