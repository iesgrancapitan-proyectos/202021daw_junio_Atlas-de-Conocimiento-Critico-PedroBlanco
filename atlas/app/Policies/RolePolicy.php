<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
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
        // Para ver los roles, se debe estar registrado
        return ($user->role_id <= Role::IS_USER);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $role
     * @return mixed
     */
    public function view(User $user, Role $role)
    {
        // Para ver los roles, se debe estar registrado
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
        // No se van a crear roles
        return false;
        // En un futuro, para crear roles, se debe ser superusuario
        // return ($user->role_id == Role::IS_SUPER);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $role
     * @return mixed
     */
    public function update(User $user, Role $role)
    {
        // No se van a crear roles
        return false;
        // En un futuro, para crear roles, se debe ser superusuario
        // return ($user->role_id == Role::IS_SUPER);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $role
     * @return mixed
     */
    public function delete(User $user, Role $role)
    {
        // No se van a borrar roles
        return false;
        // En un futuro, para borrar roles, se debe ser superusuario
        // return ($user->role_id == Role::IS_SUPER);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $role
     * @return mixed
     */
    public function restore(User $user, Role $role)
    {
        // No se van a recuperar roles
        return false;
        // En un futuro, para recuperar roles, se debe ser superusuario
        // return ($user->role_id == Role::IS_SUPER);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Role  $role
     * @return mixed
     */
    public function forceDelete(User $user, Role $role)
    {
        // No se van a eliminar roles
        return false;
        // En un futuro, para eliminar roles, se debe ser superusuario
        // return ($user->role_id == Role::IS_SUPER);
    }
}
