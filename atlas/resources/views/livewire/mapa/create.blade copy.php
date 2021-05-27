<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    {{-- The Master doesn't talk, he acts. --}}
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>?
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="">
                        <div class="mb-4">
                            <label for="inputNombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="inputNombre" placeholder="Introduzca el nombre" wire:model="nombre">
                            @error('nombre') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="textDescripcion" class="block text-gray-700 text-sm font-bold mb-2">Descripci&oacute;n:</label>
                            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="textDescripcion" wire:model="descripcion" placeholder="Introduzca una descripci&oacute;n"></textarea>
                            @error('descripcion') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="textComentario" class="block text-gray-700 text-sm font-bold mb-2">Comentario:</label>
                            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="textComentario" wire:model="comentario" placeholder="Introduzca un comentario"></textarea>
                            @error('comentario') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="inputURL" class="block text-gray-700 text-sm font-bold mb-2">P&aacute;gina web:</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="inputURL" placeholder="Introduzca una p&aacute;gina web" wire:model="url">
                            @error('url') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4" style="clear: both;">
                            <div style="float: left;">
                                <label for="f_creacion" class="block text-gray-700 text-sm font-bold mb-2">Fecha de creaci&oacute;n: </label>
                                <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="f_creacion" id="f_creacion" wire:model="f_creacion"
                                @if(isset($f_creacion))
                                value="{{$f_creacion}}"
                                @endif
                                required>
                            </div>
                            <div style="float: right;">
                                <label for="f_actualizado" class="block text-gray-700 text-sm font-bold mb-2">Fecha de actualizaci&oacute;n: </label>
                                <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="f_actualizado" id="f_actualizado" wire:model="f_actualizado"
                                @if(isset($f_actualizado))
                                value="{{$f_actualizado}}"
                                @endif
                                required>
                            </div>
                        </div>
                        @if(isset($administraciones))
                        <div class="mb-4">
                            <label for="administracion_id" class="block text-gray-700 text-sm font-bold mb-2">Administraci&oacute;n: </label>
                            <select name="administracion_id" id="administracion_id" wire:model="administracion_id" required>
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
                        <div class="mb-4">
                            <label for="ambito_id" class="block text-gray-700 text-sm font-bold mb-2">&Aacute;mbito: </label>
                            <select name="ambito_id" id="ambito_id" wire:model="ambito_id" required>
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
                        <div class="mb-4">
                            <label for="estado_id" class="block text-gray-700 text-sm font-bold mb-2">Estados: </label>
                            <select name="estado_id" id="estado_id" wire:model="estado_id" required>
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
                        <div class="mb-4">
                            <label for="select_autores_id" class="block text-gray-700 text-sm font-bold mb-2">Autor(es): (se puede seleccionar m&aacute;s de un/a)</label>
                            <select name="select_autores_id[]" id="select_autores_id" wire:model="select_autores_id" multiple required>
                                @foreach ($autores as $autor)
                                <option value="{{$autor->id}}" {{-- FIXME: tal vez se más rápido marcar selected con JavaScript --}}
                                    @if ( in_array ( $autor->id, $select_autores_id, true ) )
                                    selected
                                    {{-- @else
                                    selected="false" --}}
                                    @endif
                                    >{{$autor->apellidos}}, {{$autor->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        @else
                        <div>No se han encontrado Autores definidos.</div>
                        @endif
                        {{-- <script>console.log({{ print_r($select_autores_id, true) }});</script> --}}
                        @if(isset($geos))
                        <div class="mb-4">
                            <label for="select_geos_id" class="block text-gray-700 text-sm font-bold mb-2">Localizaci&oacute;n(es) Geogr&aacute;fica(s): (se puede seleccionar m&aacute;s de una)</label>
                            <select name=select_geos_id[]" id="select_geos_id" wire:model="select_geos_id" multiple required>
                                @foreach ($geos as $geo)
                                <option value="{{$geo->id}}" {{-- FIXME: tal vez se más rápido marcar selected con JavaScript --}}
                                    @if ( in_array ( $geo->id, $select_geos_id, true ) )
                                    selected
                                    {{-- @else
                                    selected="false" data-debug="{{var_dump($select_geos_id)}}" --}}
                                    @endif
                                    >{{$geo->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        @else
                        <div>No se han encontrado Localizaciones Geogr&aacute;ficas definidas.</div>
                        @endif
                        {{-- <script>console.log({{ print_r($select_geos_id, true) }});</script> --}}
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
