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
                        <input type="text" name="nombre" id="nombre" value="{{$mapa->nombre}}" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripci&oacute;n: </label>
                        <textarea name="descripcion" id="descripcion" cols="30" rows="10" required>{{$mapa->descripcion}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="url">P&aacute;gina web: </label>
                        <input type="text" name="url" id="url" value="{{$mapa->url}}" required>
                    </div>
                    <div class="form-group">
                        <label for="comentario">Comentario: </label>
                        <textarea name="comentario" id="comentario" cols="30" rows="10" required>{{$mapa->comentario}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="f_creacion">Fecha de creaci&oacute;n: </label>
                        <input type="date" name="f_creacion" id="f_creacion" value="{{$mapa->f_creacion->format('Y-m-d')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="f_actualizado">Fecha de actualizaci&oacute;n: </label>
                        <input type="date" name="f_actualizado" id="f_actualizado" value="{{$mapa->f_actualizado->format('Y-m-d')}}" required>
                    </div>
                    @if(isset($administraciones))
                    <div class="form-group">
                        <label for="administraciones">Administraci&oacute;n: </label>
                        <select name="administraciones" id="administraciones" required>
                            @foreach ($administraciones as $administracion)
                            <option value="{{$administracion->id}}" {{-- FIXME: tal vez se más rápido marcar selected con JavaScript --}}
                                @if($administracion->id === $mapa->administracion->id)
                                selected
                                @endif
                                >{{$administracion->nombre}}</option>
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
                            <option value="{{$ambito->id}}" {{-- FIXME: tal vez se más rápido marcar selected con JavaScript --}}
                                @if($ambito->id === $mapa->ambito->id)
                                selected
                                @endif
                                >{{$ambito->nombre}}</option>
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
                            <option value="{{$estado->id}}" {{-- FIXME: tal vez se más rápido marcar selected con JavaScript --}}
                                @if($estado->id === $mapa->estado->id)
                                selected
                                @endif
                                >{{$estado->nombre}}</option>
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
                            <option value="{{$autor->id}}" {{-- FIXME: tal vez se más rápido marcar selected con JavaScript --}}
                                @if($mapa->autores->contains($autor->id))
                                selected
                                @endif
                                >{{$autor->apellidos}}, {{$autor->nombre}}</option>
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
                            <option value="{{$geo->id}}" {{-- FIXME: tal vez se más rápido marcar selected con JavaScript --}}
                                @if($mapa->geo->contains($geo->id))
                                selected
                                @endif
                                >{{$geo->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    @else
                    <div>No se han encontrado Localizaciones Geogr&aacute;ficas definidas.</div>
                    @endif
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
