<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Atlas extends Component
{
    public $initial_query = '';
    // public $query = '';

    public function mount (Request $request)
    {
        if ( $request->get('query') ) {
            // $this->query = $this->initial_query = $request->get('query');
            $this->initial_query = $request->get('query');
            Log::debug('Search->mount() | query = '.$request->get('query') );
        } else {
            Log::debug('Search->mount() | query vacía' );
        }

    }

    public function render()
    {
        return view('livewire.atlas')->layout('layouts.base');
    }
}
