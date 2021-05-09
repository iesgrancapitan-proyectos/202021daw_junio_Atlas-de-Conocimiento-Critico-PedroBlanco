<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Mapa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{route('mapa.update',['mapa' => $mapa->id])}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre: </label>
                        <input type="text" name="nombre" id="nombre" value="{{$mapa->nombre}}">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripci&oacute;n: </label>
                        <textarea name="descripcion" id="descripcion" cols="30" rows="10">{{$mapa->descripcion}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="url">P&aacute;gina web: </label>
                        <input type="text" name="url" id="url" value="{{$mapa->url}}">
                    </div>
                    <div class="form-group">
                        <label for="comentario">Comentario: </label>
                        <textarea name="comentario" id="comentario" cols="30" rows="10">{{$mapa->comentario}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="f_creacion">Fecha de creaci&oacute;n: </label>
                        <input type="date" name="f_creacion" id="f_creacion" value="{{$mapa->f_creacion}}">
                    </div>
                    <div class="form-group">
                        <label for="f_actualizado">Fecha de actualizaci&oacute;n: </label>
                        <input type="date" name="f_actualizado" id="f_actualizado" value="{{$mapa->f_actualizado}}">
                    </div>
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
