<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Mapas') }}
        </h2>
    </x-slot>
@auth
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">Crear Mapa</h1>
                <br/>
                <form action="{{route('mapa.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre: </label>
                        <input type="text" name="nombre" id="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripci&oacute;n: </label>
                        <textarea name="descripcion" id="descripcion" cols="30" rows="10" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="url">P&aacute;gina web: </label>
                        <input type="text" name="url" id="url" required>
                    </div>
                    <div class="form-group">
                        <label for="comentario">Comentario: </label>
                        <textarea name="comentario" id="comentario" cols="30" rows="10" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="f_creacion">Fecha de creaci&oacute;n: </label>
                        <input type="date" name="f_creacion" id="f_creacion" required>
                    </div>
                    <div class="form-group">
                        <label for="f_actualizado">Fecha de actualizaci&oacute;n: </label>
                        <input type="date" name="f_actualizado" id="f_actualizado" required>
                    </div>
                    @if(isset($administraciones))
                    <div class="form-group">
                        <label for="administraciones">Administraci&oacute;n: </label>
                        <select name="administraciones" id="administraciones" required>
                            @foreach ($administraciones as $administracion)
                            <option value="{{$administracion->id}}">{{$administracion->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    @else
                    <div>No se han encontrado Administraciones definidas.</div>
                    @endif
                    @if(isset($ambitos))
                    <div class="form-group">
                        <label for="ambitos">&Aacute;mbito: </label>
                        <select name="ambitos" id="ambitos" required>
                            @foreach ($ambitos as $ambito)
                            <option value="{{$ambito->id}}">{{$ambito->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    @else
                    <div>No se han encontrado &Aacute;mbitos definidos.</div>
                    @endif
                    @if(isset($estados))
                    <div class="form-group">
                        <label for="estados">Estados: </label>
                        <select name="estados" id="estados" required>
                            @foreach ($estados as $estado)
                            <option value="{{$estado->id}}">{{$estado->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    @else
                    <div>No se han encontrado Estados definidos.</div>
                    @endif
                    @if(isset($autores))
                    <div class="form-group">
                        <label for="autores">Autor(es): (se puede seleccionar m&aacute;s de una/a)</label>
                        <select name="autores[]" id="autores" multiple required>
                            @foreach ($autores as $autor)
                            <option value="{{$autor->id}}">{{$autor->apellidos}}, {{$autor->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    @else
                    <div>No se han encontrado Autores definidos.</div>
                    @endif
                    @if(isset($geos))
                    <div class="form-group">
                        <label for="geos">Localizaci&oacute;n(es) Geogr&aacute;fica(s): (se puede seleccionar m&aacute;s de una)</label>
                        <select name="geos[]" id="geos" multiple required>
                            @foreach ($geos as $geo)
                            <option value="{{$geo->id}}">{{$geo->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    @else
                    <div>No se han encontrado Localizaciones Geogr&aacute;ficas definidas.</div>
                    @endif
                    <div>
                        <br/>
                        <button class="border" type="reset">Limpiar</button>
                        <button class="border" type="submit">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endauth

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Mostrar Mapas</h2>
                <br/>
                @if(isset($mapas))
                <ul>
                    @foreach ($mapas as $mapa)
                    <li>
                        <h3 class="font-semibold text-l text-gray-800 leading-tight">{{$mapa->nombre}}</h3>
                        <br/>
                        <a href="{{route('mapa.show',['mapa' => $mapa->id])}}">
                            <button class="border">Mostrar</button>
                        </a>
                        @auth
                        <br/>
                        <a href="{{route('mapa.edit',['mapa' => $mapa->id])}}">
                            <button class="border">Editar</button>
                        </a>
                        <form action="{{route('mapa.delete',['mapa' => $mapa->id])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="border" type="submit">Borrar</button>
                        </form>
                        @endauth
                    </li>
                    @endforeach
                </ul>
                @else
                <h3 class="font-semibold text-l text-gray-800 leading-tight">No se ha definido Mapa.</h3>
                @endif
            </div>
        </div>
    </div>
</div>
</x-app-layout>
