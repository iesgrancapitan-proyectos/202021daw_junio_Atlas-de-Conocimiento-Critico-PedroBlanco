{{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('messages.Users') }}
    </h2>
</x-slot>

<div>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        @livewire('users.show', ['users' => $users, 'roles' => $roles])
    </div>
</div>
