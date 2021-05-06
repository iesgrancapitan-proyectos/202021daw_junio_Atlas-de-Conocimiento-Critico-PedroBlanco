<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Autores') }}
        </h2>
    </x-slot>
@auth
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">Crear Autor</h1>
                <br/>
                <form action="{{route('autor.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre: </label>
                        <input type="text" name="nombre" id="nombre">
                    </div>
                    <div class="form-group">
                        <label for="apellidos">Apellidos: </label>
                        <input type="text" name="apellidos" id="apellidos">
                    </div>
                    <div class="form-group">
                        <label for="url">P&aacute;gina web: </label>
                        <input type="text" name="url" id="url">
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
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Lista de Autores</h2>
                <br/>
                @if(isset($autores))
                <ul>
                    @foreach ($autores as $autor)
                    <li>
                        <h3 class="font-semibold text-l text-gray-800 leading-tight">{{$autor->apellidos}}, {{$autor->nombre}}</h3>
                        <br/>
                        <a href="{{route('autor.show',['autor' => $autor->id])}}">
                            <button class="border">Mostrar</button>
                        </a>
                        @auth
                        <br/>
                        <a href="{{route('autor.edit',['autor' => $autor->id])}}">
                            <button class="border">Editar</button>
                        </a>
                        <form action="{{route('autor.delete',['autor' => $autor->id])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="border" type="submit">Borrar</button>
                        </form>
                        @endauth
                    </li>
                    @endforeach
                </ul>
                @else
                <h3 class="font-semibold text-l text-gray-800 leading-tight">No se ha definido &Aacute;mbito.</h3>
                @endif
            </div>
        </div>
    </div>
</div>
</x-app-layout>
