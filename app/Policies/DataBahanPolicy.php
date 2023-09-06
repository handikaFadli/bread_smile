<?php

namespace App\Policies;

use App\Models\DataBahan;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class DataBahanPolicy
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
        return $user->role == 'gudang' || $user->role == 'backoffice'
            ? Response::allow()
            :  Response::denyWithStatus(404);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DataBahan  $dataBahan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, DataBahan $dataBahan)
    {
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->role == 'gudang' || $user->role == 'backoffice'
            ? Response::allow()
            :  Response::denyWithStatus(404);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DataBahan  $dataBahan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        return $user->role == 'gudang' || $user->role == 'backoffice'
            ? Response::allow()
            :  Response::denyWithStatus(404);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DataBahan  $dataBahan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, DataBahan $dataBahan)
    {
        return $user->role == 'gudang' || $user->role == 'backoffice'
            ? Response::allow()
            :  Response::denyWithStatus(404);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DataBahan  $dataBahan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, DataBahan $dataBahan)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DataBahan  $dataBahan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, DataBahan $dataBahan)
    {
        //
    }
}
