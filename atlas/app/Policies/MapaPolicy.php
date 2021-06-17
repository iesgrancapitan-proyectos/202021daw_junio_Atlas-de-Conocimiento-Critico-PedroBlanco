<?php

namespace App\Policies;

use App\Models\Mapa;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Access\HandlesAuthorization;

class MapaPolicy
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
        // Todos los usuarios, autenticados o no, pueden ver los mapas
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Mapa  $mapa
     * @return mixed
     */
    public function view(User $user = null, Mapa $mapa)
    {
        // Todos los usuarios, autenticados o no, pueden ver los mapas
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
        Log::debug('MapaPolicy->create: '.$user->role_id. '<= '.Role::IS_MAP_EDITOR);
        // Para poder crear un mapa, se debe ser, como poco, Editor de Mapas
        return ( $user->role_id <= Role::IS_MAP_EDITOR );
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Mapa  $mapa
     * @return mixed
     */
    public function update(User $user, Mapa $mapa)
    {
        return ($user->role_id <= Role::IS_MAP_EDITOR);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Mapa  $mapa
     * @return mixed
     */
    public function delete(User $user, Mapa $mapa)
    {
        return ($user->role_id <= Role::IS_MAP_EDITOR);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Mapa  $mapa
     * @return mixed
     */
    public function restore(User $user, Mapa $mapa)
    {
        return ($user->role_id <= Role::IS_MAP_EDITOR);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Mapa  $mapa
     * @return mixed
     */
    public function forceDelete(User $user, Mapa $mapa)
    {
        return ($user->role_id <= Role::IS_MAP_EDITOR);
    }
}
