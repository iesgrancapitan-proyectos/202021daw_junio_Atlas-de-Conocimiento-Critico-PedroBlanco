<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <form action="#" method="GET" wire:submit.prevent="search">
        @csrf

        <div class="block space-x-4 space-y-4 flex">
            {{-- <x-jet-label for="search" value="{{ __('Buscar') }}" /> --}}
            <input class='cthulhu flex-1 border-gray-300 focus:border-pink-300 focus:ring focus:ring-pink-300 focus:ring-opacity-50 rounded-md shadow-sm w-1/2' name="query" id="query" wire:model="query" type="search" placeholder="Buscar..." value="{{$query}}"/>
        </div>
    </form>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div id="map"></div>
    </div>
    @if ($mapas)
    <div class="block space-x-4 space-y-4 p-10 max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <p><h2 class="font-semibold text-xl text-gray-800 leading-tight">Mapas encontrados:</h2></p>
        @foreach($mapas as $mapa)
            <p class="font-semibold text-l text-gray-800 leading-tight"><a href="{{ $mapa->url }}" target="_blank" rel="noreferrer noopener">{{ $mapa->nombre }}</a></p>
            @foreach($mapa->geo()->get(['nombre','latitud','longitud']) as $valor)
            {{-- {{$valor->latitud}},{{$valor->longitud}} --}}
{{--                                console.log({!! json_encode([$valor->latitud,$valor->longitud]) !!});--}}
            @push('scripts')
            <script>
                console.group();
                console.log('{{$mapa->nombre}}');
                console.log([{{$valor->latitud}},{{$valor->longitud}}]);
                console.groupEnd();
                //L.marker(center).addTo(map);
                L.marker([{{$valor->latitud}},{{$valor->longitud}}],
                    {icon: default_icon})
                    .bindPopup('{{$mapa->nombre}}<br/><em>{{$valor->nombre}}</em>')
                    .addTo(map);
            </script>
            @endpush
            @endforeach
        @endforeach
    </div>
    @endif
    @if ($autores)
    <div class="block space-x-4 space-y-4 p-10 max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <p><h2 class="font-semibold text-xl text-gray-800 leading-tight">Autores/as encontrados:</h2></p>
        @foreach($autores as $autor)
            <p class="font-semibold text-l text-gray-800 leading-tight"><a href="{{ $autor->url }}" target="_blank" rel="noreferrer noopener">{{ $autor->nombre }} {{ $autor->apellidos }}</a></p>
        @endforeach
    </div>
    @endif
    @if ($geos)
    <div class="block space-x-4 space-y-4 p-10 max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <p><h2 class="font-semibold text-xl text-gray-800 leading-tight">Localizaciones encontradas:</h2></p>
        @foreach($geos as $geo)
            <p class="font-semibold text-l text-gray-800 leading-tight">{{ $geo->nombre }}</p>
        @endforeach
    </div>
    @endif
</div>
