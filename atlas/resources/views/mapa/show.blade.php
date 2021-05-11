<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Datos del Mapa: ') }}"{{$mapa->nombre}}"
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="font-bold text-xl text-gray-800 leading-tight">{{$mapa->nombre}}</h1>
                    <br/>
                    <p class="border font-semibold text-l text-gray-800 leading-tight">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Descripci&oacute;n:</h2>
                        {{$mapa->descripcion}}
                    </p>
                    <br/>
                    <p class="border font-semibold text-l text-gray-800 leading-tight">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Comentario:</h2>
                        {{$mapa->comentario}}
                    </p>
                    <br/>
                    <p class="border font-semibold text-l text-gray-800 leading-tight">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">P&aacute;gina web:</h2>
                        <a href="{{$mapa->url}}" target="_blank">{{$mapa->url}}</a>
                    </p>
                    <br/>
                    <p class="border font-semibold text-l text-gray-800 leading-tight">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Autor(es):</h2>
                        <ul>
                        @foreach ($mapa->autores()->get() as $autor)
                        <li><a href="/autor/{{$autor->id}}" target="_blank">{{$autor->apellidos}}, {{$autor->nombre}}</a></li>
                        @endforeach
                        </ul>
                    </p>
                    <br/>
                    <p class="border font-semibold text-l text-gray-800 leading-tight">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Administraci&oacute;n:</h2>
                        <ul>
                        @foreach ($mapa->administracion()->get() as $administracion)
                        <li><a href="/administracion/{{$administracion->id}}" target="_blank">{{$administracion->nombre}}</a></li>
                        @endforeach
                        </ul>
                    </p>
                    <br/>
                    <p class="border font-semibold text-l text-gray-800 leading-tight">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">&Aacute;mbitos:</h2>
                        <ul>
                        @foreach ($mapa->ambito()->get() as $ambito)
                        <li><a href="/ambito/{{$ambito->id}}" target="_blank">{{$ambito->nombre}}</a></li>
                        @endforeach
                        </ul>
                    </p>
                    <br/>
                    <p class="border font-semibold text-l text-gray-800 leading-tight">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Localizaciones geogr&aacute;ficas:</h2>
                        <ul>
                        @foreach ($mapa->geo()->get() as $geo)
                        <li><a href="/geo/{{$geo->id}}" target="_blank">{{$geo->nombre}}</a></li>
                        @endforeach
                        </ul>
                    </p>
                    <br/>
                    <p class="border font-semibold text-l text-gray-800 leading-tight">Creado: {{$mapa->f_creacion}}
                        <br/>Actualizado: {{$mapa->f_actualizado}}
                    </p>
                    <br/>
                    <a href="{{route('mapa.index')}}">Volver</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
