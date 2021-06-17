<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Log;

trait InlineSearch
{
    public $query = '';
    public $initial_query = '';
    public $results = null;
    public $model = '';
    public $contenedor = null;

    public function inline_search()
    {
        Log::debug ( $this->model.'->inline_search () + "'. $this->query .'"' );

        if ( $this->query != '' ) {
            $this->results = $this->model::search($this->query)->get();
        }

        $this->emit($this->model.'_inline_search');
        Log::debug ( $this->model.'->emit ("'. $this->model .'_inline_search")' );

        return $this->results;
    }
}
