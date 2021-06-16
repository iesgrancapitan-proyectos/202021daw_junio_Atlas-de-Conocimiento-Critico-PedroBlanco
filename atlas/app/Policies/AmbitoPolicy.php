<?php

namespace App\Policies;

use App\Models\Ambito;
use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class AmbitoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        // Todos los usuarios, autenticados o no, pueden ver los ámbitos
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ambito  $ambito
     * @return mixed
     */
    public function view(User $user, Ambito $ambito)
    {
        // Todos los usuarios, autenticados o no, pueden ver los ámbitos
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // Para poder crear un ámbito, se debe ser, como poco, Editor de Sitio
        return ( $user->role_id <= Role::IS_SITE_EDITOR );
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ambito  $ambito
     * @return mixed
     */
    public function update(User $user, Ambito $ambito)
    {
        // Para poder modificar un ámbito, se debe ser, como poco, Editor de Sitio
        return ( $user->role_id <= Role::IS_SITE_EDITOR );
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ambito  $ambito
     * @return mixed
     */
    public function delete(User $user, Ambito $ambito)
    {
        // Para poder borrar un ámbito, se debe ser, como poco, Editor de Sitio
        return ( $user->role_id <= Role::IS_SITE_EDITOR );
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ambito  $ambito
     * @return mixed
     */
    public function restore(User $user, Ambito $ambito)
    {
        // Para poder recuperar un ámbito, se debe ser, como poco, Editor de Sitio
        return ( $user->role_id <= Role::IS_SITE_EDITOR );
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ambito  $ambito
     * @return mixed
     */
    public function forceDelete(User $user, Ambito $ambito)
    {
        // Para poder forzar el borrado de un ámbito, se debe ser, como poco, Editor de Sitio
        return ( $user->role_id <= Role::IS_SITE_EDITOR );
    }
}
