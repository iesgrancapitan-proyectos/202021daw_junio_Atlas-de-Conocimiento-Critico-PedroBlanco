<?php

namespace App\Http\Livewire;

use App\Models\Geo;

use App\Models\Mapa;
use App\Models\Autor;
use App\Models\Ambito;
use App\Models\Estado;
use Livewire\Component;
use App\Models\Geo_Mapa;

use App\Models\Autor_Mapa;
use Illuminate\Http\Request;

use App\Models\Administracion;

use App\Http\Traits\InlineSearch;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class WireMapa extends Component
{
    use AuthorizesRequests;
    use InlineSearch;

    public  $nombre,
            $descripcion,
            $url,
            $comentario,
            $f_creacion,
            $f_actualizado,
            $administracion_id,
            $ambito_id,
            $estado_id,
            $_id;

    public  $autores_id,
            $geos_id;

    public  $select_autores_id,
            $select_geos_id;

    public  $administraciones,
            $estados,
            $ambitos,
            $autores,
            $geos;

    public $geos_markers;

    public $isOpen = 0;

    protected $listeners = [ 'App\Models\Mapa_inline_search' => 'render' ];

    public $mensajes = array(
        'titulo_pagina' => 'Gestión de Mapas',
        'boton_crear' => 'Crear nuevo Mapa'
    );

    protected $rules = [
        'nombre' => 'required',
        'descripcion' => 'nullable',
        'url' => 'nullable|url',
        'comentario' => 'nullable',
        'f_creacion' => 'nullable|date_format:Y-m-d',
        'f_actualizado' => 'nullable|date_format:Y-m-d',
        'administracion_id' => 'required',
        'ambito_id' => 'required',
        'estado_id' => 'required',
        // Habrá que activar la validación en otro sitio?
        // FIXME: Comprobar si funciona aquí o no
        // 'autores_id' => 'required',
        // 'geos_id' => 'required',
        'autores_id.*' => 'nullable',
        'geos_id.*' => 'nullable',
        'autores' => 'nullable',
        'geos' => 'nullable',
        'select_autores_id.*' => 'nullable',
        'select_geos_id.*' => 'nullable',
    ];

    public function mount (Request $request)
    {
        $this->model = 'App\Models\Mapa';

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
        $this->authorize('viewAny', Mapa::class);
        $this->authorize('viewAny', Geo::class);

        if ( $this->query != '' ) {
            $this->contenedor = $this->inline_search ();
        } else {
            $this->contenedor = Mapa::latest()->get();
        }

        $this->geos_markers = $this->get_geos_markers();

        return view('livewire.wire-mapa');
    }

    public function create()
    {
        $this->authorize('create', Mapa::class);
        $this->authorize('create', Autor_Mapa::class);
        $this->authorize('create', Geo_Mapa::class);

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
        $this->url = '';
        $this->comentario = '';
        $this->f_creacion = '';
        $this->f_actualizado = '';
        $this->administracion_id = '';
        $this->ambito_id = '';
        $this->estado_id = '';
        $this->_id = null;

        $this->autores_id = Array();
        $this->geos_id = Array();

        $this->select_autores_id = Array();
        $this->select_geos_id = Array();

        $this->administraciones = Administracion::latest()->get();
        $this->estados = Estado::latest()->get();
        $this->ambitos = Ambito::latest()->get();
        $this->autores = Autor::latest()->get();
        $this->geos = Geo::latest()->get();

        $this->geos_markers = $this->get_geos_markers();
    }

    public function store()
    {
        // dd($this);
        // dd($this->autores);
        // dd($this->geos);
        // dd($this->autores_id);
        // dd(array_keys($this->autores_id));
        // dd(array_keys($this->selected_autores_id));

        if ( ! empty ( $this->_id ) ) {
            $this->authorize('update', Mapa::findOrFail($this->_id));
        } else {
            $this->authorize('create', Mapa::class);
        }

        // Las operaciones ->sync() qué tipo de permisos requieren y cuándo?
        $this->authorize('create', Autor_Mapa::class);
        $this->authorize('create', Geo_Mapa::class);

        $this->validate();

        $temp_mapa = Mapa::updateOrCreate(['id' => $this->_id], [
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'url' => $this->url,
            'comentario' => $this->comentario,
            'f_creacion' => $this->f_creacion,
            'f_actualizado' => $this->f_actualizado,
            'administracion_id' => $this->administracion_id,
            'ambito_id' => $this->ambito_id,
            'estado_id' => $this->estado_id,
        ]);

        $temp_mapa->autores()->sync($this->select_autores_id);
        $temp_mapa->geo()->sync($this->select_geos_id);

        // $temp_mapa->autores()->sync($this->autores);
        // $temp_mapa->geo()->sync($this->geos);


        session()->flash('message',
            $this->_id ? 'Mapa actualizado correctamente.' : 'Mapa creado correctamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        // FIXME: Habría que devolver error si no se encuentra el mapa
        $mapa = Mapa::findOrFail($id);

        $this->authorize('update', $mapa);

        // Las operaciones ->sync() qué tipo de permisos requieren y cuándo?
        $this->authorize('create', Autor_Mapa::class);
        $this->authorize('create', Geo_Mapa::class);


        $this->_id = $id;
        $this->nombre = $mapa->nombre;
        $this->descripcion = $mapa->descripcion;
        $this->url = $mapa->url;
        $this->comentario = $mapa->comentario;
        $this->f_creacion = $mapa->f_creacion->format('Y-m-d');
        $this->f_actualizado = $mapa->f_actualizado->format('Y-m-d');
        $this->administracion_id = $mapa->administracion_id;
        $this->ambito_id = $mapa->ambito_id;
        $this->estado_id = $mapa->estado_id;

        // La lista de autores y geos seleccionados (tb unidos originalmente)
        $this->select_autores_id = $mapa->autores()->get()->pluck('id')->toArray();
        $this->select_geos_id = $mapa->geo()->get()->pluck('id')->toArray();

        // Guardamos los ids de los autores y los geos conectados al mapa actual en un array _flipped_ a los anteriores
        // Para facilitar la búsqueda en la plantilla
        $this->autores_id = array_flip ( $this->select_autores_id );
        $this->geos_id = array_flip ( $this->select_geos_id );


        $this->administraciones = Administracion::latest()->get();
        $this->estados = Estado::latest()->get();
        $this->ambitos = Ambito::latest()->get();
        $this->autores = Autor::latest()->get();
        $this->geos = Geo::latest()->get();

        $this->openModal();
    }

    public function delete($id)
    {
        $mapa = Mapa::find($id);

        $this->authorize('delete', $mapa);

        $mapa->delete();

        session()->flash('message', 'Mapa borrado correctamente.');
    }

    public function toggleAutor($id)
    {
        $_pos = array_search ( $id, $this->select_autores_id, true );
        // Log::debug('Autor - '.$_pos );

        if ( $_pos === false ) {
            array_push ($this->select_autores_id, $id);
            // Log::debug( 'WireMapa->toggleAutor('.$id.') -> '.print_r( $this->select_autores_id, true ) );
        } else {
            unset( $this->select_autores_id[$_pos] );
            // Log::debug( 'WireMapa->toggleAutor('.$id.')['.$_pos.'] <- '.print_r( $this->select_autores_id, true ) );
        }
    }

    public function toggleGeo ( $id )
    {
        $_pos = array_search ( $id, $this->select_geos_id, true );
        // Log::debug('Geo - '.$_pos );

        if ( $_pos === false ) {
            array_push ($this->select_geos_id, $id);
            // Log::debug( 'WireMapa->toggleGeo('.$id.') -> '.print_r( $this->select_geos_id, true ) );
        } else {
            unset( $this->select_geos_id[$_pos] );
            // Log::debug( 'WireMapa->toggleGeo('.$id.')['.$_pos.'] <- '.print_r( $this->select_geos_id, true ) );
        }
    }

    protected function get_geos_markers ()
    {
        $this->authorize('viewAny', Geo::class);

        $geos_array = [];

        $geos_collection = Geo::get(['longitud','latitud'])->toArray();

        foreach ( $geos_collection as $geo ) {
            $geos_array[] = [(double)$geo['longitud'],(double)$geo['latitud']];
        };


        // $geos_array = [
        //     [-4.84772405594904,37.9567116],[-3.49205561203722,37.9557275]
        // ];

        // return json_encode ( $geos_array );

        // dd ( $geos_array, json_encode ( $geos_array ) );
        return $geos_array;

        // return [[-4.84772405594904,37.9567116],[-3.49205561203722,37.9557275]];

    }
}
