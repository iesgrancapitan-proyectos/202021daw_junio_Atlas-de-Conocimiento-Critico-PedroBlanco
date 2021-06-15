<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    {{-- The Master doesn't talk, he acts. --}}
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div wire:click="closeModal()" class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>?
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full md:max-w-2xl md:w-2xl lg:max-w-4xl lg:w-4xl xl:max-w-6xl xl:w-6xl" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="">
                        <div class="mb-4 block">
                            <label for="inputNombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="inputNombre" placeholder="Introduzca el nombre" wire:model.defer="nombre">
                            @error('nombre') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4 block">
                            <label for="textDescripcion" class="block text-gray-700 text-sm font-bold mb-2">Descripci&oacute;n:</label>
                            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="textDescripcion" wire:model.defer="descripcion" placeholder="Introduzca una descripci&oacute;n"></textarea>
                            @error('descripcion') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4 block">
                            <label for="textComentario" class="block text-gray-700 text-sm font-bold mb-2">Comentario:</label>
                            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="textComentario" wire:model.defer="comentario" placeholder="Introduzca un comentario"></textarea>
                            @error('comentario') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4 block">
                            <label for="inputURL" class="block text-gray-700 text-sm font-bold mb-2">P&aacute;gina web:</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="inputURL" placeholder="Introduzca una p&aacute;gina web" wire:model.defer="url">
                            @error('url') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4 inline-block">
                            <label for="f_creacion" class="block text-gray-700 text-sm font-bold mb-2">Fecha de creaci&oacute;n: </label>
                            <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="f_creacion" id="f_creacion" wire:model.defer="f_creacion"
                            @if(isset($f_creacion))
                            value="{{$f_creacion}}"
                            @endif
                            required>
                        </div>
                        <div class="mb-4 inline-block">
                            <label for="f_actualizado" class="block text-gray-700 text-sm font-bold mb-2">Fecha de actualizaci&oacute;n: </label>
                            <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="f_actualizado" id="f_actualizado" wire:model.defer="f_actualizado"
                            @if(isset($f_actualizado))
                            value="{{$f_actualizado}}"
                            @endif
                            required>
                        </div>
                        @if(isset($administraciones))
                        <div class="mb-4 inline-block">
                            <br/>
                            <label for="administracion_id" class="block text-gray-700 text-sm font-bold mb-2">Administraci&oacute;n: </label>
                            <select name="administracion_id" id="administracion_id" wire:model.defer="administracion_id" required>
                                @foreach ($administraciones as $administracion)
                                <option value="{{$administracion->id}}" {{-- FIXME: tal vez se más rápido marcar selected con JavaScript --}}
                                    @if($administracion->id === $administracion_id)
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
                        <div class="mb-4 inline-block">
                            <label for="ambito_id" class="block text-gray-700 text-sm font-bold mb-2">&Aacute;mbito: </label>
                            <select name="ambito_id" id="ambito_id" wire:model.defer="ambito_id" required>
                                @foreach ($ambitos as $ambito)
                                <option value="{{$ambito->id}}" {{-- FIXME: tal vez se más rápido marcar selected con JavaScript --}}
                                    @if($ambito->id === $ambito_id)
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
                        <div class="mb-4 inline-block">
                            <label for="estado_id" class="block text-gray-700 text-sm font-bold mb-2">Estados: </label>
                            <select name="estado_id" id="estado_id" wire:model.defer="estado_id" required>
                                @foreach ($estados as $estado)
                                <option value="{{$estado->id}}" {{-- FIXME: tal vez se más rápido marcar selected con JavaScript --}}
                                    @if($estado->id === $estado_id)
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
                        <div class="mb-4 block">
                            {{-- <label for="autores_id" class="block text-gray-700 text-sm font-bold mb-2">Autor(es): (se puede seleccionar m&aacute;s de una/a)</label> --}}
                            <label class="block text-gray-700 text-sm font-bold mb-2">Autor(es):</label>

                            {{-- <select name="autores_id[]" id="autores_id" wire:init="mount({{ $_id }})" wire:model.defer="autores_id" multiple required> --}}

                            {{-- Con esta línea van los datos bien, no se muestran seleccionados y no vuelven bien cuando son modificados --}}
                            {{-- <select name="autores_id[]" id="autores_id" wire:model.defer="autores" multiple required> --}}

                            {{-- Con esta línea van los datos bien, no se muestran seleccionados y da error cuando son modificados --}}
                            {{-- <select name="autores_id[]" id="autores_id" wire:model="autores" multiple required> --}}

                            {{-- Con esta línea van y vienen bien los datos pero no se muestran como seleccionados --}}
                            {{-- <select name="autores_id[]" id="autores_id" wire:model.defer="autores_id" multiple required> --}}

                            {{-- Con esta línea van los datos bien y se muestran seleccionados, pero no vuelven bien --}}
                            {{-- <select name="autores_id[]" id="autores_id" multiple required> --}}

                            {{-- Con esta línea van y vienen bien los datos pero no se muestran como seleccionados --}}
                            {{-- Al devolver los datos, los cambiados tienen una representación diferente --}}
                            {{-- <select name="autores[]" id="autores" wire:model.defer="autores_id" multiple required> --}}

                            {{-- Los datos van bien, no se muestran seleccionados y vuelven raros --}}
                            {{-- <select name="a[]" id="a" wire:model="select_autores_id" multiple required> --}}
{{--
                                @foreach ($autores as $autor)
                                <option value="{{$autor->id}}"
                                    wire:click="toggleAutor({{$autor->id}})"
                                    @if ( isset ( $autores_id[$autor->id] ) )
                                    selected
                                    @endif
                                    >{{$autor->apellidos}}, {{$autor->nombre}}</option>
                                @endforeach
                            </select> --}}

                            @foreach ($autores as $autor)
                            <input type="checkbox" name="autor_{{$autor->id}}" id="autor_{{$autor->id}}" value="{{$autor->id}}"
                                wire:click="toggleAutor({{$autor->id}})"
                                @if ( isset ( $autores_id[$autor->id] ) )
                                checked
                                @endif
                                />
                            <label for="autor_{{$autor->id}}">{{$autor->apellidos}}, {{$autor->nombre}}</label>
                            <br/>
                            @endforeach

                        </div>
                        @else
                        <div>No se han encontrado Autores definidos.</div>
                        @endif
                        @if(isset($geos))
                        <div class="mb-4 block">
                            {{-- <label for="geos" class="block text-gray-700 text-sm font-bold mb-2">Localizaci&oacute;n(es) Geogr&aacute;fica(s): (se puede seleccionar m&aacute;s de una)</label> --}}
                            <label class="block text-gray-700 text-sm font-bold mb-2">Localizaci&oacute;n(es) Geogr&aacute;fica(s):</label>

                            {{-- Con esta línea van y vienen bien los datos pero no se muestran como seleccionados --}}
                            {{-- <select name="geos_id[]" id="geos_id" wire:model.defer="geos_id" multiple required> --}}

                            {{-- <select name="geos_id[]" id="geos_id" wire:init="$emitTo( 'livewire.mapa.create', 'mount({{ $_id }}' )" wire:model.defer="geos_id" multiple required> --}}

                            {{-- Con esta línea van los datos bien, no se muestran seleccionados y no vuelven bien cuando son modificados --}}
                            {{-- <select name="geos_id[]" id="geos_id" wire:model.defer="geos" multiple required> --}}

                            {{-- Con esta línea van los datos bien, no se muestran seleccionados y da error cuando son modificados --}}
                            {{-- <select name="geos_id[]" id="geos_id" wire:model="geos" multiple required> --}}

                            {{-- Con esta línea van los datos bien y se muestran seleccionados, pero no vuelven bien --}}
                            {{-- <select name="geos_id[]" id="geos_id" multiple required> --}}

                            {{-- Con esta línea van y vienen bien los datos pero no se muestran como seleccionados --}}
                            {{-- Al devolver los datos, los cambiados tienen una representación diferente --}}
                            {{-- <select name="geos[]" id="geos" wire:model.defer="geos_id" multiple required> --}}

                            {{-- Los datos van bien, no se muestran seleccionados y vuelven raros --}}
                            {{-- <select name="g[]" id="g" wire:model="select_geos_id" multiple required> --}}

{{--
                                @foreach ($geos as $geo)
                                <option value="{{$geo->id}}"
                                    wire:click="toggleGeo({{$geo->id}})"
                                    @if ( isset ( $geos_id[$geo->id] ) )
                                    selected
                                    @endif
                                    >{{$geo->nombre}}</option>
                                @endforeach
                            </select> --}}


                            @foreach ($geos as $geo)
                            <input type="checkbox" name="geo_{{$geo->id}}" id="geo_{{$geo->id}}" value="geo_{{$geo->id}}"
                                wire:click="toggleGeo({{$geo->id}})"
                                @if ( isset ( $geos_id[$geo->id] ) )
                                checked
                                @endif
                                />
                                <label for="geo_{{$geo->id}}">{{$geo->nombre}}</label>
                                <br/>
                            @endforeach

                        </div>
                        @else
                        <div>No se han encontrado Localizaciones Geogr&aacute;ficas definidas.</div>
                        @endif

                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse" style="clear: both;">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Guardar
                        </button>
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button wire:click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Cancelar
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
