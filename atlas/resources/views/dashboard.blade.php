<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Operaciones implementadas:</h2>
                    <ul>
                        <li><a href="/administracion">CRUD de Administraciones.</a></li>
                        <li><a href="/ambito">CRUD de &Aacute;mbitos.</a></li>
                        <li><a href="/estado">CRUD de Estados.</a></li>
                        <li><a href="/autor">CRUD de Autores.</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
