<?php

namespace App\Policies;

use App\Models\Autor;
use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class AutorPolicy
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
        // Todos los usuarios, autenticados o no, pueden ver los autores
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Autor  $autor
     * @return mixed
     */
    public function view(User $user = null, Autor $autor)
    {
        // Todos los usuarios, autenticados o no, pueden ver los autores
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
        // Para poder crear un autor, se debe ser, como poco, Editor de Mapa
        return ( $user->role_id <= Role::IS_MAP_EDITOR );
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Autor  $autor
     * @return mixed
     */
    public function update(User $user, Autor $autor)
    {
        // Para poder modificar un autor, se debe ser, como poco, Editor de Mapa
        return ( $user->role_id <= Role::IS_MAP_EDITOR );
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Autor  $autor
     * @return mixed
     */
    public function delete(User $user, Autor $autor)
    {
        // Para poder borrar un autor, se debe ser, como poco, Editor de Mapa
        return ( $user->role_id <= Role::IS_MAP_EDITOR );
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Autor  $autor
     * @return mixed
     */
    public function restore(User $user, Autor $autor)
    {
        // Para poder recuperar un autor, se debe ser, como poco, Editor de Mapa
        return ( $user->role_id <= Role::IS_MAP_EDITOR );
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Autor  $autor
     * @return mixed
     */
    public function forceDelete(User $user, Autor $autor)
    {
        // Para poder eliminar un autor, se debe ser, como poco, Editor de Mapa
        return ( $user->role_id <= Role::IS_MAP_EDITOR );
    }
}
