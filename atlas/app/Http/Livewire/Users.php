<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;

class Users extends Component
{
    public $users, $roles;

    protected $listeners = ['users_render' => 'render'];

    public function render()
    {
        $this->users = User::latest()->get();
        $this->roles = Role::latest()->get();

        // dd ( $this->roles );

        return view('livewire.users');
    }
}
