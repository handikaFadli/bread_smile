<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Resep;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResepPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->role == 'produksi' || $user->role == 'backoffice'
            ? Response::allow()
            :  Response::denyWithStatus(404);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Resep $resep)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->role == 'produksi' || $user->role == 'backoffice'
            ? Response::allow()
            :  Response::denyWithStatus(404);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Resep $resep)
    {
        return $user->role == 'produksi' || $user->role == 'backoffice'
            ? Response::allow()
            :  Response::denyWithStatus(404);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Resep $resep)
    {
        return $user->role == 'produksi' || $user->role == 'backoffice'
            ? Response::allow()
            :  Response::denyWithStatus(404);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Resep $resep)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Resep $resep)
    {
        //
    }
}
