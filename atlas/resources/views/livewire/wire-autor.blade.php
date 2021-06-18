<div>
    {{-- The Master doesn't talk, he acts. --}}
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-2">
                {{ $mensajes['titulo_pagina'] }}
            </h2>
            <div class="flex-1 text-right">@include('livewire.inline-search', ['model' => $model])</div>
        </div>
    </x-slot>
    <div class="py-6">
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
                @can('create', App\Models\Autor::class)
                    <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">{{$mensajes['boton_crear']}}</button>
                    @if($isOpen)
                        @include('livewire.autor.create')
                    @endif
                @endcan
                <table class="table-fixed w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            {{-- <th class="px-4 py-2 w-20">Número</th> --}}
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Apellidos</th>
                            <th class="px-4 py-2">Acci&oacute;n</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contenedor as $item)
                        <tr>
                            {{-- <td class="border px-4 py-2">{{ $item->id }}</td> --}}
                            <td class="border px-4 py-2">{{ $item->nombre }}</td>
                            <td class="border px-4 py-2">{{ $item->apellidos }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ $item->url }}" target="_blank" rel="noreferrer noopener" class="button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Visitar web</a>
                                @can('update', $item)
                                    <button wire:click="edit({{ $item->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</button>
                                @endcan
                                @can('delete', $item)
                                    <button wire:click="delete({{ $item->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Borrar</button>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

