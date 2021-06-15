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
                    @can('admin-users')
                    <form x-data="{show_{{$user->id}}: true, selected_role_{{$user->id}}: -2}"
                        {{-- wire:init="loadRole({{$user->id}})" --}}
                        >
                        @csrf
                        <select name="role_{{$user->id}}" id="role_{{$user->id}}"
                            x-on:change="$wire.selected_role[{{$user->id}}] = this.value; show_{{$user->id}} = false;"
                            {{-- wire:model="selected_role" --}}
                            required>
                            <option value="-1">Sin rol asignado</option>
                            @foreach ($roles as $role)
                            <option value="{{$role->id}}"
                                @if ( ( null !== $user->role()->get()->first() ) && ( $role->id === $user->role()->first()->id ) )
                                    selected
                                @endif
                                >{{$role->nombre}}</option>
                            @endforeach
                        </select>
                        <x-jet-danger-button class="ml-2" x-bind:disabled="show_{{$user->id}}"
                            {{-- x-bind:value="selected_role_{{$user->id}}" --}}
                            x-on:click="$wire.changeRole({{$user->id}})"
                            {{-- x-on:click="$wire.changeRole({{$user->id}},selected_role_{{$user->id}})" --}}
                            >Guardar</x-jet-danger-button>
                        {{-- <x-jet-danger-button class="ml-2" x-bind:disabled="show_{{$user->id}}" wire:click="changeRole">Guardar</x-jet-danger-button> --}}
                        {{-- <button x-show="show_{{$user->id}}" x-on:click=""
                            type="button" class="inline-flex justify-center rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Guardar
                        </button> --}}
                    </form>
                    @else
                        {{ $user->role()->get()->first() ? $user->role()->get()->first()->nombre : 'Sin rol asignado' }}
                    @endcan
                </td>
                <td class="border px-4 py-2">
                    <a href=""><x-fluentui-person-info-16 class="h-6 w-6" /></a>
                    @can('admin-users')
                        <a href=""><x-fluentui-person-settings-16 class="h-6 w-6" /></a>
                        <a href=""><x-fluentui-person-delete-16 class="h-6 w-6" /></a>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
