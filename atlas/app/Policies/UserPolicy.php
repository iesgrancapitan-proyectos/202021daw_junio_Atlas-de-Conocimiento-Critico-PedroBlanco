<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
        // Para ver los detalles de un usuario, se debe estar registrado
        return ($user->role_id <= Role::IS_USER);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        // Para ver los detalles de un usuario, se debe estar registrado
        return ($user->role_id <= Role::IS_USER);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // Para crear un usuario, se debe ser administrador
        return ($user->role_id <= Role::IS_ADMIN);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        // Para modificar un usuario no administrador, se debe ser administrador
        // Para modificar un usuario administrador o superadministrador, se debe ser superadministrador

        $permiso = false;

        if ( ( $user->role_id <= Role::IS_ADMIN ) && ( $model->role_id > Role::IS_ADMIN ) ) {
            $permiso = true;
        } elseif ( $user->role_id == Role::IS_SUPER ) {
            $permiso = true;
        } else {
            $permiso = false;
        }

        return $permiso;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        // Para eliminar un usuario no administrador, se debe ser administrador
        // Para eliminar un usuario administrador o superadministrador, se debe ser superadministrador

        $permiso = false;

        if ( ( $user->role_id <= Role::IS_ADMIN ) && ( $model->role_id > Role::IS_ADMIN ) ) {
            $permiso = true;
        } elseif ( $user->role_id == Role::IS_SUPER ) {
            $permiso = true;
        } else {
            $permiso = false;
        }

        return $permiso;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        // Para recuperar un usuario no administrador, se debe ser administrador
        // Para recuperar un usuario administrador o superadministrador, se debe ser superadministrador

        $permiso = false;

        if ( ( $user->role_id <= Role::IS_ADMIN ) && ( $model->role_id > Role::IS_ADMIN ) ) {
            $permiso = true;
        } elseif ( $user->role_id == Role::IS_SUPER ) {
            $permiso = true;
        } else {
            $permiso = false;
        }

        return $permiso;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        // Para forzar el borrado de un usuario no administrador, se debe ser administrador
        // Para forzar el borrado de un usuario administrador o superadministrador, se debe ser superadministrador

        $permiso = false;

        if ( ( $user->role_id <= Role::IS_ADMIN ) && ( $model->role_id > Role::IS_ADMIN ) ) {
            $permiso = true;
        } elseif ( $user->role_id == Role::IS_SUPER ) {
            $permiso = true;
        } else {
            $permiso = false;
        }

        return $permiso;
    }
}
