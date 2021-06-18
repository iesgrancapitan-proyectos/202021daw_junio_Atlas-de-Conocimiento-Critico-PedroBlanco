<?php

namespace App\Http\Livewire;

use App\Models\Mapa;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Http\Traits\InlineSearch;
use Illuminate\Support\Facades\Log;

class Atlas extends Component
{
    use InlineSearch;

    protected $listeners = [ 'App\Models\Mapa_inline_search' => 'render' ];

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

        if ( $this->query != '' ) {
            $this->contenedor = $this->inline_search ();
        } else {
            $this->contenedor = Mapa::latest()->get();
        }

        $this->geos_markers = $this->get_geos_markers();

        return view('livewire.atlas')->layout('layouts.base');
    }
}
