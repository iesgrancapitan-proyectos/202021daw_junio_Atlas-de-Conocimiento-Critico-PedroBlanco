<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Mapas') }}
        </h2>
    </x-slot>
@auth
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">Crear Mapa</h1>
                <br/>
                <form action="{{route('mapa.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre: </label>
                        <input type="text" name="nombre" id="nombre">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripci&oacute;n: </label>
                        <textarea name="descripcion" id="descripcion" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="url">P&aacute;gina web: </label>
                        <input type="text" name="url" id="url">
                    </div>
                    <div class="form-group">
                        <label for="comentario">Comentario: </label>
                        <textarea name="comentario" id="comentario" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="f_creacion">Fecha de creaci&oacute;n: </label>
                        <input type="date" name="f_creacion" id="f_creacion">
                    </div>
                    <div class="form-group">
                        <label for="f_actualizado">Fecha de actualizaci&oacute;n: </label>
                        <input type="date" name="f_actualizado" id="f_actualizado">
                    </div>
                    <div>
                        <br/>
                        <button class="border" type="reset">Limpiar</button>
                        <button class="border" type="submit">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endauth

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Mostrar Mapas</h2>
                <br/>
                @if(isset($mapas))
                <ul>
                    @foreach ($mapas as $mapa)
                    <li>
                        <h3 class="font-semibold text-l text-gray-800 leading-tight">{{$mapa->nombre}}</h3>
                        <br/>
                        <a href="{{route('mapa.show',['mapa' => $mapa->id])}}">
                            <button class="border">Mostrar</button>
                        </a>
                        @auth
                        <br/>
                        <a href="{{route('mapa.edit',['mapa' => $mapa->id])}}">
                            <button class="border">Editar</button>
                        </a>
                        <form action="{{route('mapa.delete',['mapa' => $mapa->id])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="border" type="submit">Borrar</button>
                        </form>
                        @endauth
                    </li>
                    @endforeach
                </ul>
                @else
                <h3 class="font-semibold text-l text-gray-800 leading-tight">No se ha definido Mapa.</h3>
                @endif
            </div>
        </div>
    </div>
</div>
</x-app-layout>
