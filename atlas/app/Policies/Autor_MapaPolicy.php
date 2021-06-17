<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use App\Models\Autor_Mapa;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Access\HandlesAuthorization;

class Autor_MapaPolicy
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
     * @param  \App\Models\Autor_Mapa  $autorMapa
     * @return mixed
     */
    public function view(User $user = null, Autor_Mapa $autorMapa)
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
        Log::debug('Autor_MapaPolicy->create: '.$user->role_id. '<= '.Role::IS_MAP_EDITOR);
        // Para poder crear una relación, se debe ser, como poco, Editor de Mapa
        return ( $user->role_id <= Role::IS_MAP_EDITOR );
        // return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Autor_Mapa  $autorMapa
     * @return mixed
     */
    public function update(User $user, Autor_Mapa $autorMapa)
    {
        // Para poder actualizar una relación, se debe ser, como poco, Editor de Mapa, aunque no tiene mucho sentido (no hay margen de actualización)
        return ( $user->role_id <= Role::IS_MAP_EDITOR );
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Autor_Mapa  $autorMapa
     * @return mixed
     */
    public function delete(User $user, Autor_Mapa $autorMapa)
    {
        // Para poder borrar una relación, se debe ser, como poco, Editor de Mapa
        return ( $user->role_id <= Role::IS_MAP_EDITOR );
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Autor_Mapa  $autorMapa
     * @return mixed
     */
    public function restore(User $user, Autor_Mapa $autorMapa)
    {
        // Para poder restaurar una relación, se debe ser, como poco, Editor de Mapa
        return ( $user->role_id <= Role::IS_MAP_EDITOR );
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Autor_Mapa  $autorMapa
     * @return mixed
     */
    public function forceDelete(User $user, Autor_Mapa $autorMapa)
    {
        // Para poder eliminar una relación, se debe ser, como poco, Editor de Mapa
        return ( $user->role_id <= Role::IS_MAP_EDITOR );
    }
}
