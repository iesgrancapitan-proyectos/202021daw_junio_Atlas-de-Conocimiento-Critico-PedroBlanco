<?php

namespace App\Policies;

use App\Models\Estado;
use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class EstadoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user = null)
    {
        // Todos los usuarios, autenticados o no, pueden ver los estados
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Estado  $estado
     * @return mixed
     */
    public function view(User $user = null, Estado $estado)
    {
        // Todos los usuarios, autenticados o no, pueden ver los estados
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
        // Para poder crear un estado, se debe ser, como poco, Editor de Sitio
        return ( $user->role_id <= Role::IS_SITE_EDITOR );
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Estado  $estado
     * @return mixed
     */
    public function update(User $user, Estado $estado)
    {
        // Para poder modificar un estado, se debe ser, como poco, Editor de Sitio
        return ( $user->role_id <= Role::IS_SITE_EDITOR );
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Estado  $estado
     * @return mixed
     */
    public function delete(User $user, Estado $estado)
    {
        // Para poder borrar un estado, se debe ser, como poco, Editor de Sitio
        return ( $user->role_id <= Role::IS_SITE_EDITOR );
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Estado  $estado
     * @return mixed
     */
    public function restore(User $user, Estado $estado)
    {
        // Para poder recuperar un estado, se debe ser, como poco, Editor de Sitio
        return ( $user->role_id <= Role::IS_SITE_EDITOR );
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Estado  $estado
     * @return mixed
     */
    public function forceDelete(User $user, Estado $estado)
    {
        // Para poder forzar el borrado de un estado, se debe ser, como poco, Editor de Sitio
        return ( $user->role_id <= Role::IS_SITE_EDITOR );
    }
}
