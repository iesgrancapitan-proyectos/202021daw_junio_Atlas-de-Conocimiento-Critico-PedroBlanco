<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle: ') }}{{$administracion->nombre}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Descripci&oacute;n:</h2>
                    <br/>
                    <p class="border font-semibold text-l text-gray-800 leading-tight">{{$administracion->descripcion}}</p>
                    <br/>
                    <a href="{{route('administracion.index')}}">Volver</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
