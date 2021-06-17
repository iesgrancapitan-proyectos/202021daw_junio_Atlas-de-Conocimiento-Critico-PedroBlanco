<x-jet-dialog-modal>
    <x-slot name="title">
        Cambiar de rol al usuario <em>{{$user_modal->name}}</em>
    </x-slot>
    <x-slot name="content">
        <form>
            @foreach ($roles as $role)
                <input wire:model="selected_role" type="radio" name="role" id="{{$role->id}}" value="{{$role->id}}">
                <label for="{{$role->id}}">{{$role->nombre}}</label>
                <br/>
            @endforeach
        </form>
    </x-slot>
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('abrir_modal', false)">
            Cancelar
        </x-jet-secondary-button>
        <x-jet-danger-button wire:click="saveRole">
            Confirmar
        </x-jet-danger-button>
    </x-slot>
</x-jet-dialog-modal>
