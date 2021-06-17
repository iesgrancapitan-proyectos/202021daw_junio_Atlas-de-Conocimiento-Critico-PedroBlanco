<?php

namespace App\Http\Livewire;

use App\Models\Geo;
use App\Models\Mapa;
use App\Models\User;
use App\Models\Autor;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Search extends Component
{
    public $query = '';
    public $results = null;

    public function render ()
    {
        //$results = User::where('name', $this->query)->get();

        Log::debug('Render: '.$this->query );

        return view('livewire.search', [
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
}
