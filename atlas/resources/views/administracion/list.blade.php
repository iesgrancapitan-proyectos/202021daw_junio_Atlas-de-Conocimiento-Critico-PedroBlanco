<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Administraciones') }}
        </h2>
    </x-slot>
@auth
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">Crear Administraci&oacute;n</h1>
                <br/>
                <form action="{{route('administracion.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre: </label>
                        <input type="text" name="nombre" id="nombre">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripci&oacute;n: </label>
                        <textarea name="descripcion" id="descripcion" cols="30" rows="10"></textarea>
                    </div>
                    <div>
                        <button type="submit">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endauth

@if(isset($administraciones))
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Mostrar Administraciones</h2>
                <br/>
                <ul>
                    @foreach ($administraciones as $administracion)
                    <li>
                        <a href="{{route('administracion.show',['administracion' => $administracion->id])}}">{{$administracion->nombre}}</a>
                        @auth
                        <br>
                        <a href="{{route('administracion.edit',['administracion' => $administracion->id])}}">
                            <button>Editar</button>
                        </a>
                        <form action="{{route('administracion.delete',['administracion' => $administracion->id])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Borrar</button>
                        </form>
                        @endauth
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endif
</x-app-layout>
