<?php

namespace App\Http\Livewire\Mapa;

use Livewire\Component;
use App\Models\Mapa;

use Illuminate\Support\Facades\Log;

class Create extends Component
{
    public function render()
    {
        return view('livewire.mapa.create');
    }
}
