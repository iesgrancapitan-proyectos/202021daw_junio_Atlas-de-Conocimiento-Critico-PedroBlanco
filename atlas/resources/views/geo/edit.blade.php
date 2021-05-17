<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Localización Geográfica') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{route('geo.update',['geo' => $geo->id])}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre: </label>
                        <input type="text" name="nombre" id="nombre" value="{{$geo->nombre}}">
                    </div>
                    <div class="form-group">
                        <label for="dir3">DIR3: </label>
                        <input type="text" name="dir3" id="dir3" value="{{$geo->dir3}}">
                    <div>
                        <button class="border" type="reset">Limpiar</button>
                        <button class="border" type="submit">Guardar cambios</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
