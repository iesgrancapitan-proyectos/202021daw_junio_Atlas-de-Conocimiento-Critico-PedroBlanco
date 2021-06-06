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
                    {{-- <x-mapbox id="mio" theme="light-v10" class="rounded-lg shadow-lg h-96 mt-6"
                    :options="['center' => [-4.575648, 37.46335], 'zoom' => 6.2 ]"
                    :markers="[[-4.575648, 37.46335]]"
                    /> --}}
                    {{-- :options="['center' => [-4.84772405594904, 37.9567116], 'zoom' => 7 ]" --}}
                    {{-- :options="[ 'zoom' => 7 ]" --}}
                    {{-- :markers="{!! [[-4.7841887,37.8841488]] !!}" --}}
                    {{-- :markers="[[-4.7841887,37.8841488],[-5.9436615,37.4822431],[-4.7826835,37.8866752],[-4.7826835,37.8866752],[-3.6361438,38.0913123],[-6.1553866,36.4174639],[-2.4433644,36.8238722],[-4.7881483,37.8777414],[-6.1508098,36.699219]]" --}}
                    {{-- :markers="[[-4.84772405594904,37.9567116],[-3.49205561203722,37.9557275]]" --}}
                    {{-- :markers="{{ $geos_markers }}" --}}
                    {{-- <script>
                    @foreach ($geos_markers as $marker)
                        // new mapboxgl.Marker()
                        //     .setLngLat({{ json_encode($marker) }})
                        //     .addTo(mapa_mio);
                        console.log( {{ json_encode($marker) }});
                    @endforeach
                    </script> --}}
                    <div id="map"></div>
                </div>


                <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">{{$mensajes['boton_crear']}}</button>
                @if($isOpen)
                    @include('livewire.mapa.create')
                @endif
                <table class="table-fixed w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 w-20">Número</th>
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Descripci&oacute;n</th>
                            <th class="px-4 py-2">Acci&oacute;n</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contenedor as $item)
                        <tr>
                            <td class="border px-4 py-2">{{ $item->id }}</td>
                            <td class="border px-4 py-2">{{ $item->nombre }}</td>
                            <td class="border px-4 py-2">{{ $item->descripcion }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ $item->url }}" target="_blank" rel="noreferrer noopener" class="button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Visitar web</a>
                                <button wire:click="edit({{ $item->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</button>
                                <button wire:click="delete({{ $item->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Borrar</button>
                                {{-- @push('scripts') --}}
                                @foreach($item->geo()->get(['latitud','longitud'])->toArray() as $valor)
                                <script>
                                    console.log({{json_encode($valor)}});
                                </script>
                                @endforeach
                                {{-- @endpush --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
