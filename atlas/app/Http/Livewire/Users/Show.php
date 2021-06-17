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

    public $selected_role = null;
    public $selected_user = [];

    public $abrir_modal = false;
    public $user_modal = [];

    public function mount ( $users, $roles )
    {
        $this->authorize('viewAny', User::class);
        $this->authorize('viewAny', Role::class);

        $this->users = $users;
        $this->roles = $roles;

        $_role = null;

        $this->selected_user = $users->pluck('role_id','id')->toArray();

        Log:debug(print_r( $this->selected_user, true ));

        // foreach ( $this->users as $_user ) {
        //     $_role = $_user->role()->first();
        //     $this->selected_role[$_user->id] = ( null !== $_role ) ? $_role->id : null ;
        // }
    }

    public function render()
    {
        $this->authorize('viewAny', User::class);

        return view('livewire.users.show');
    }

    // public function changeRole()
    // {
    //     Log::debug("changeRole()");
    // }

    public function changeRole( $user_id )
    {
        // Log::debug("changeRole($user_id) => ".$this->selected_role[$user_id]);
        // Log::debug("changeRole($user_id) -> ". $this->selected_role[$user_id]);
        // dd($user);
        // Log::debug("changeRole($user_id)");

        $this->user_modal = $this->users->find($user_id);
        //dd($this->user_modal);

        $this->selected_role = $this->user_modal->role_id;

        Log::debug("changeRole($user_id) desde ".$this->selected_role );

        $this->abrir_modal = true;
    }

    public function saveRole()
    {
        Log::debug("saveRole: ".$this->user_modal->name." -> ".$this->selected_role );
        $this->abrir_modal = false;

        $this->user_modal->role_id = $this->selected_role;

        $this->user_modal->save();

        $this->emit('render');

        Log::debug("saved! ".$this->user_modal->name." -> ".$this->user_modal->role_id );
    }
}
