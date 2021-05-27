<?php

namespace App\Http\Livewire\Mapa;

use Livewire\Component;
use App\Models\Mapa;


class Create extends Component
{
/*
    public $autores_id, $geos_id;
*/

    public function render()
    {
        return view('livewire.mapa.create');
    }
/*
    // Idea sacada de https://laracasts.com/discuss/channels/livewire/show-selected-option-in-livewire-not-working
    // Pero no parece funcionar (o soluciona un problema diferente)
    public function mount( $id )
    {
        dd($id);
        if ( isset ( $id ) ) {
            $this->autores_id = array_flip ( Mapa::find($id)->autores()->get()->pluck('id')->toArray() );
            $this->geos_id = array_flip ( Mapa::find($id)->autores()->get()->pluck('id')->toArray() );
        } else {
            $this->autores_id = Array();
            $this->geos_id = Array();
        }
    }
*/
}
