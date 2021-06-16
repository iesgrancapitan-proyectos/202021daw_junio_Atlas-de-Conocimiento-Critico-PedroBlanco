<?php

namespace App\Policies;

use App\Models\Geo;
use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class GeoPolicy
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
        // Todos los usuarios, autenticados o no, pueden ver las localizaciones
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Geo  $geo
     * @return mixed
     */
    public function view(User $user = null, Geo $geo)
    {
        // Todos los usuarios, autenticados o no, pueden ver las localizaciones
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
        // Para poder crear una localización, se debe ser, como poco, Editor de Mapa
        return ( $user->role_id <= Role::IS_MAP_EDITOR );
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Geo  $geo
     * @return mixed
     */
    public function update(User $user, Geo $geo)
    {
        // Para poder actualizar una localización, se debe ser, como poco, Editor de Mapa
        return ( $user->role_id <= Role::IS_MAP_EDITOR );
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Geo  $geo
     * @return mixed
     */
    public function delete(User $user, Geo $geo)
    {
        // Para poder borrar una localización, se debe ser, como poco, Editor de Mapa
        return ( $user->role_id <= Role::IS_MAP_EDITOR );
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Geo  $geo
     * @return mixed
     */
    public function restore(User $user, Geo $geo)
    {
        // Para poder recuperar una localización, se debe ser, como poco, Editor de Mapa
        return ( $user->role_id <= Role::IS_MAP_EDITOR );
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Geo  $geo
     * @return mixed
     */
    public function forceDelete(User $user, Geo $geo)
    {
        // Para poder eliminar una localización, se debe ser, como poco, Editor de Mapa
        return ( $user->role_id <= Role::IS_MAP_EDITOR );
    }
}
