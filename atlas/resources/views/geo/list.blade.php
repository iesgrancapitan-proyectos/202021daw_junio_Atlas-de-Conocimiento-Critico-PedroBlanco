<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Localizaciones Geográficas') }}
        </h2>
    </x-slot>
@auth
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">Crear Localizaci&oacute;n Geogr&aacute;fica</h1>
                <br/>
                <form action="{{route('geo.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre: </label>
                        <input type="text" name="nombre" id="nombre">
                    </div>
                    <div class="form-group">
                        <label for="dir3">DIR3 </label>
                        <input type="text" name="dir3" id="dir3">
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
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Mostrar Localizaciones Geogr&aacute;ficas</h2>
                <br/>
                @if(isset($geos))
                <ul>
                    @foreach ($geos as $geo)
                    <li>
                        <h3 class="font-semibold text-l text-gray-800 leading-tight">{{$geo->nombre}}</h3>
                        <br/>
                        <a href="{{route('geo.show',['geo' => $geo->id])}}">
                            <button class="border">Mostrar</button>
                        </a>
                        @auth
                        <br/>
                        <a href="{{route('geo.edit',['geo' => $geo->id])}}">
                            <button class="border">Editar</button>
                        </a>
                        <form action="{{route('geo.delete',['geo' => $geo->id])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="border" type="submit">Borrar</button>
                        </form>
                        @endauth
                    </li>
                    @endforeach
                </ul>
                @else
                <h3 class="font-semibold text-l text-gray-800 leading-tight">No se han definido Localizaciones Geogr&aacute;ficas.</h3>
                @endif
            </div>
        </div>
    </div>
</div>
</x-app-layout>
