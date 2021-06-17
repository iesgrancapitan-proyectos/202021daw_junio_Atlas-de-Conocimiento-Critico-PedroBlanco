<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use App\Models\Geo_Mapa;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Access\HandlesAuthorization;

class Geo_MapaPolicy
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
        // Todos los usuarios, autenticados o no, pueden ver estas relaciones
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Geo_Mapa  $geoMapa
     * @return mixed
     */
    public function view(User $user = null, Geo_Mapa $geoMapa)
    {
        // Todos los usuarios, autenticados o no, pueden ver estas relaciones
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
        Log::debug('Geo_MapaPolicy->create: '.$user->role_id);
        // Para poder crear una relación, se debe ser, como poco, Editor de Mapa
        return ( $user->role_id <= Role::IS_MAP_EDITOR );
        // return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Geo_Mapa  $geoMapa
     * @return mixed
     */
    public function update(User $user, Geo_Mapa $geoMapa)
    {
        // Para poder actualizar una relación, se debe ser, como poco, Editor de Mapa, aunque no tiene mucho sentido (no hay margen de actualización)
        return ( $user->role_id <= Role::IS_MAP_EDITOR );
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Geo_Mapa  $geoMapa
     * @return mixed
     */
    public function delete(User $user, Geo_Mapa $geoMapa)
    {
        // Para poder borrar una relación, se debe ser, como poco, Editor de Mapa
        return ( $user->role_id <= Role::IS_MAP_EDITOR );
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Geo_Mapa  $geoMapa
     * @return mixed
     */
    public function restore(User $user, Geo_Mapa $geoMapa)
    {
        // Para poder restaurar una relación, se debe ser, como poco, Editor de Mapa
        return ( $user->role_id <= Role::IS_MAP_EDITOR );
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Geo_Mapa  $geoMapa
     * @return mixed
     */
    public function forceDelete(User $user, Geo_Mapa $geoMapa)
    {
        // Para poder eliminar una relación, se debe ser, como poco, Editor de Mapa
        return ( $user->role_id <= Role::IS_MAP_EDITOR );
    }
}
