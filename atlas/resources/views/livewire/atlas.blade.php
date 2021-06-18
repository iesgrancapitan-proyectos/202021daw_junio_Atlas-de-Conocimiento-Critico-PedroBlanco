<div>
    {{-- The Master doesn't talk, he acts. --}}
    <x-slot name="head">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Atlas de Conocimiento Crítico') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        @bukStyles

        <x-load-leaflet></x-load-leaflet>

        <style>
            #map { height: 400px; }
        </style>

        @stack('css')

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </x-slot>
    <x-slot name="body">
        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <header class="bg-white shadow flex">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex-1">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Atlas de Conocimiento Crítico') }}
                    </h2>
                </div>
                <div class="flex-1 text-right">@include('livewire.inline-search', ['model' => $model])</div>
            </header>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div id="map"></div>
            </div>

            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        {{-- <th class="px-4 py-2 w-20">Número</th> --}}
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Descripci&oacute;n</th>
                        <th class="px-4 py-2">Datos varios</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contenedor as $item)
                    <tr>
                        @if ( !empty($item->url))
                        <a href="{{$item->url}}"><x-fluentui-globe-16-o  class="h-6 w-6"/></a>
                        @endif
                        {{-- <td class="border px-4 py-2">{{ $item->id }}</td> --}}
                        <td class="border px-4 py-2">
                            @if ( !empty($item->url))
                            <a href="{{$item->url}}"><x-fluentui-globe-16-o  class="h-6 w-6"/></a>
                            @endif
                            {{ $item->nombre }}
                        </td>
                        <td class="border px-4 py-2">{{ $item->descripcion }}
                        <br/>
                        @foreach($item->geo()->get(['nombre','latitud','longitud']) as $valor)
                        {{-- {{$valor->latitud}},{{$valor->longitud}} --}}
{{--                                console.log({!! json_encode([$valor->latitud,$valor->longitud]) !!});--}}
                        @push('scripts')
                        <script>
                            console.group();
                            console.log('{{$item->nombre}}');
                            console.log([{{$valor->latitud}},{{$valor->longitud}}]);
                            console.groupEnd();
                            //L.marker(center).addTo(map);
                            L.marker([{{$valor->latitud}},{{$valor->longitud}}],
                                {icon: default_icon})
                                .bindPopup('{{$item->nombre}}<br/><em>{{$valor->nombre}}</em>')
                                .addTo(map);
                        </script>
                        @endpush
                        @endforeach
                        </td>
                        <td class="border px-4 py-2">
                            <ul>
                                <li><em>Ámbito/Alcance</em>: {{$item->ambito->nombre}}</li>
                                <li><em>Estado</em>: {{$item->estado->nombre}}</li>
                                <li><em>Administración</em>: {{$item->administracion->nombre}}</li>
                            </dl>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>





        </div>


        @stack('modals')

        <div name="contenedor_mapas">
            <x-init-leaflet></x-init-leaflet>

            @stack('scripts')
        </div>

        @livewireScripts

        @bukScripts

    </x-slot>
</div>
