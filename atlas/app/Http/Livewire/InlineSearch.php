<?php

namespace App\Http\Livewire;

use App\Models\Geo;
use App\Models\Mapa;
use App\Models\User;
use App\Models\Autor;
use App\Models\Ambito;
use App\Models\Estado;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Administracion;
use Illuminate\Support\Facades\Log;

class InlineSearch extends Component
{
    public $query = '';
    public $results = null;

    public function mount ( $model )
    {
        Log::debug('InlineSearch Mount:'. $model);
    }

    public function render ()
    {
        //$results = User::where('name', $this->query)->get();

        Log::debug('InlineSearch Render: '.$this->query );

        return view('livewire.inline-search', [
            'mapas' => $this->search_Mapa ( $this->query ),
            'autores' => $this->search_Autor ( $this->query ),
            'geos' => $this->search_Geo ( $this->query ),
        ]);
    }

    public function search ()
    {
        Log::debug('Search: '.$this->query );
//        return $this->results = User::where('name', $this->query)->get();
    }

    public function search_Mapa( $busqueda )
    {
        $mapas = null;

        if ( $busqueda != '' ) {
            $mapas = Mapa::search($busqueda)->get();
        }

        return $mapas;
    }

    public function search_Autor( $busqueda )
    {
        $autores = null;

        if ( $busqueda != '' ) {
            $autores = Autor::search($busqueda)->get();
        }

        return $autores;
    }

    public function search_Geo( $busqueda )
    {
        $geos = null;

        if ( $busqueda != '' ) {
            $geos = Geo::search($busqueda)->get();
        }

        return $geos;
    }

    public function search_Ambito( $busqueda )
    {
        $ambitos = null;

        if ( $busqueda != '' ) {
            $ambitos = Ambito::search($busqueda)->get();
        }

        return $ambitos;
    }

    public function search_Administracion( $busqueda )
    {
        $administraciones = null;

        if ( $busqueda != '' ) {
            $administraciones = Administracion::search($busqueda)->get();
        }

        return $administraciones;
    }

    public function search_Estado( $busqueda )
    {
        $estados = null;

        if ( $busqueda != '' ) {
            $estados = Estado::search($busqueda)->get();
        }

        return $estados;
    }

    public function search_User( $busqueda )
    {
        $users = null;

        if ( $busqueda != '' ) {
            $users = User::search($busqueda)->get();
        }

        return $users;
    }
}

