<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Ámbitos') }}
        </h2>
    </x-slot>
@auth
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">Crear &Aacute;mbito</h1>
                <br/>
                <form action="{{route('ambito.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre: </label>
                        <input type="text" name="nombre" id="nombre">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripci&oacute;n: </label>
                        <textarea name="descripcion" id="descripcion" cols="30" rows="10"></textarea>
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
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Mostrar &Aacute;mbitos</h2>
                <br/>
                @if(isset($ambitos))
                <ul>
                    @foreach ($ambitos as $ambito)
                    <li>
                        <h3 class="font-semibold text-l text-gray-800 leading-tight">{{$ambito->nombre}}</h3>
                        <br/>
                        <a href="{{route('ambito.show',['ambito' => $ambito->id])}}">
                            <button class="border">Mostrar</button>
                        </a>
                        @auth
                        <br/>
                        <a href="{{route('ambito.edit',['ambito' => $ambito->id])}}">
                            <button class="border">Editar</button>
                        </a>
                        <form action="{{route('ambito.delete',['ambito' => $ambito->id])}}" method="POST">
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