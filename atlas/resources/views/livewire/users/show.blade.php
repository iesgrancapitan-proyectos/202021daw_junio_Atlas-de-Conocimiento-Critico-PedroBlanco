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
                {{-- <th class="px-4 py-2 w-20">{{ __('messages.Actions')}}</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach( $users as $user )
            <tr>
                {{-- <td class="border px-4 py-2">{{ $user->id }}</td> --}}
                <td class="border px-4 py-2">{{ $user->name }}</td>
                <td class="border px-4 py-2">{{ $user->email }}</td>
                <td class="border px-4 py-2 text-center">
                    @can('update', $user)
                    <x-jet-danger-button class="ml-2"
                        wire:click="changeRole('{{$user->id}}')">{{ $user->role()->get()->first() ? $user->role()->get()->first()->nombre : 'Sin rol asignado' }}</x-jet-danger-button>
                    @else
                        {{ $user->role()->get()->first() ? $user->role()->get()->first()->nombre : 'Sin rol asignado' }}
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if ( $abrir_modal )
        @include('livewire.users.role')
    @endif
</div>
