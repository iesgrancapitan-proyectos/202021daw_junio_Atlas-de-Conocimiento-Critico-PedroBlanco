<?php

namespace App\Policies;

use App\Models\Administracion;
use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdministracionPolicy
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
        // Todos los usuarios, autenticados o no, pueden ver las administraciones
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Administracion  $administracion
     * @return mixed
     */
    public function view(User $user = null, Administracion $administracion)
    {
        // Todos los usuarios, autenticados o no, pueden ver las administraciones
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
        // Para poder crear una administración, se debe ser, como poco, Editor de Sitio
        return ( $user->role_id <= Role::IS_SITE_EDITOR );
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Administracion  $administracion
     * @return mixed
     */
    public function update(User $user, Administracion $administracion)
    {
        // Para poder modificar una administración, se debe ser, como poco, Editor de Sitio
        return ( $user->role_id <= Role::IS_SITE_EDITOR );
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Administracion  $administracion
     * @return mixed
     */
    public function delete(User $user, Administracion $administracion)
    {
        // Para poder borrar una administración, se debe ser, como poco, Editor de Sitio
        return ( $user->role_id <= Role::IS_SITE_EDITOR );
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Administracion  $administracion
     * @return mixed
     */
    public function restore(User $user, Administracion $administracion)
    {
        // Para poder recuperar una administración, se debe ser, como poco, Editor de Sitio
        return ( $user->role_id <= Role::IS_SITE_EDITOR );
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Administracion  $administracion
     * @return mixed
     */
    public function forceDelete(User $user, Administracion $administracion)
    {
        // Para poder forzar el borrado de una administración, se debe ser, como poco, Editor de Sitio
        return ( $user->role_id <= Role::IS_SITE_EDITOR );
    }
}
