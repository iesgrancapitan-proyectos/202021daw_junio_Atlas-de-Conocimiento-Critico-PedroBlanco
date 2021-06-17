<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Log;

trait InlineSearch
{
    public $query = '';
    public $results = null;
    public $model = '';
    public $contenedor = null;

//    protected $listeners = [ $model.'_search' => 'render' ];

    // public function search_model( $busqueda, $model )
    // public function search( $busqueda )
    public function inline_search()
    {
        // Log:debug ( 'search_model ("'. $busqueda .'", "'. $model .'")' );
        Log::debug ( $this->model.'->inline_search () + "'. $this->query .'")' );

        // if ( $busqueda != '' ) {
        if ( $this->query != '' ) {
            // $this->results = $model::search($busqueda)->get();
            // $this->results = $this->model::search($busqueda)->get();
            $this->results = $this->model::search($this->query)->get();
        }

        $this->emit($this->model.'_inline_search');
        Log::debug ( $this->model.'->emit ("'. $this->model .'_inline_search")' );

        return $this->results;
    }
}
