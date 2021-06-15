<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $mensajes['titulo_pagina'] }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                @if (session()->has('message'))
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                      <div class="flex">
                        <div>
                          <p class="text-sm">{{ session('message') }}</p>
                        </div>
                      </div>
                    </div>
                @endif

                {{-- <div>{{ json_encode ($geos_markers) }}</div> --}}

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div id="map"></div>
                </div>


                <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">{{$mensajes['boton_crear']}}</button>
                @if($isOpen)
                    @include('livewire.mapa.create')
                @endif
                <table class="table-fixed w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            {{-- <th class="px-4 py-2 w-20">Número</th> --}}
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Descripci&oacute;n</th>
                            <th class="px-4 py-2">Acci&oacute;n</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contenedor as $item)
                        <tr>
                            {{-- <td class="border px-4 py-2">{{ $item->id }}</td> --}}
                            <td class="border px-4 py-2">{{ $item->nombre }}</td>
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
                                <a href="{{ $item->url }}" target="_blank" rel="noreferrer noopener" class="button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Visitar web</a>
                                <button wire:click="edit({{ $item->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</button>
                                <button wire:click="delete({{ $item->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Borrar</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
