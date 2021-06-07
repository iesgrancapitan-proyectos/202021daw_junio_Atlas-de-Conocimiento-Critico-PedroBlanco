<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\Log;

class Show extends Component
{
    use AuthorizesRequests;

    public $users;
    public $roles;

    public $selected_role = [];

    public function mount ( $users, $roles )
    {
        $this->users = $users;
        $this->roles = $roles;

        $_role = null;

        foreach ( $this->users as $_user ) {
            $_role = $_user->role()->first();
            $this->selected_role[$_user->id] = ( null !== $_role ) ? $_role->id : null ;
        }
    }

    public function render()
    {
        $this->authorize('show-users', $this->users);

        return view('livewire.users.show');
    }

    // public function changeRole()
    // {
    //     Log::debug("changeRole()");
    // }

    public function changeRole( $user_id )
    {
        Log::debug("changeRole($user_id) => ".$this->selected_role[$user_id]);
    }

    public function loadRole($id)
    {
        $_user = $this->users->find($id)->role()->first();

        if ( null !== $_user ) {
            $this->selected_role[$id] = $_user->id;
        } else {
            $this->selected_role[$id] = -1;
        }
    }
}
