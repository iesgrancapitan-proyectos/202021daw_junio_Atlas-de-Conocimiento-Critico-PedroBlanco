{{-- The whole world belongs to you. --}}
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
    {{-- <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">{{$mensajes['boton_crear']}}</button> --}}
    {{-- @if($isOpen)
        @include('livewire.generic.create')
    @endif --}}
    <table class="table-fixed w-full">
        <thead>
            <tr class="bg-gray-100">
                {{-- <th class="px-4 py-2 w-10">Id</th> --}}
                <th class="px-4 py-2">{{ __('messages.Name')}}</th>
                <th class="px-4 py-2">{{ __('messages.Email')}}</th>
                <th class="px-4 py-2">{{ __('messages.Role')}}</th>
                <th class="px-4 py-2 w-20">{{ __('messages.Actions')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $users as $user )
            <tr>
                {{-- <td class="border px-4 py-2">{{ $user->id }}</td> --}}
                <td class="border px-4 py-2">{{ $user->name }}</td>
                <td class="border px-4 py-2">{{ $user->email }}</td>
                <td class="border px-4 py-2">
                    @can('update', $user)
                    <form x-data="{show_{{$user->id}}: true, selected_role_{{$user->id}}: -2}">
                        @csrf
                        <select name="role_{{$user->id}}" id="role_{{$user->id}}" required>
                            <option value="-1">Sin rol asignado</option>
                            @foreach ($roles as $role)
                            @if ($role->id >= Auth::user()->role_id )
                            <option value="{{$role->id}}"
                                @if ( ( null !== $user->role()->get()->first() ) && ( $role->id === $user->role()->first()->id ) )
                                    selected
                                @endif
                                >{{$role->nombre}}</option>
                            @endif
                            @endforeach
                        </select>
                        <x-jet-danger-button class="ml-2" x-bind:disabled="show_{{$user->id}}">Guardar</x-jet-danger-button>
                    </form>
                    @else
                        {{ $user->role()->get()->first() ? $user->role()->get()->first()->nombre : 'Sin rol asignado' }}
                    @endcan
                </td>
                <td class="border px-4 py-2">
                    <a href=""><x-fluentui-info-16 class="h-6 w-6" /></a>
                    @can('update', $user)
                        <a href=""><x-fluentui-settings-16 class="h-6 w-6" /></a>
                    @endcan
                    @can('delete', $user)
                        <a href=""><x-fluentui-delete-16 class="h-6 w-6" /></a>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
