<?php

namespace App\Policies;

use App\Models\ProdukJadi;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProdukJadiPolicy
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
        return $user->role == 'distribusi' || $user->role == 'produksi' || $user->role == 'backoffice' || $user->role == 'kasir'
            ? Response::allow()
            :  Response::denyWithStatus(404);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProdukJadi  $produkJadi
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ProdukJadi $produkJadi)
    {
        return $user->role == 'distribusi' || $user->role == 'produksi' || $user->role == 'backoffice' || $user->role == 'kasir'
            ? Response::allow()
            :  Response::denyWithStatus(404);
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
     * @param  \App\Models\ProdukJadi  $produkJadi
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ProdukJadi $produkJadi)
    {
        return $user->role == 'produksi' || $user->role == 'backoffice'
            ? Response::allow()
            :  Response::denyWithStatus(404);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProdukJadi  $produkJadi
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ProdukJadi $produkJadi)
    {
        return $user->role == 'produksi' || $user->role == 'backoffice'
            ? Response::allow()
            :  Response::denyWithStatus(404);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProdukJadi  $produkJadi
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ProdukJadi $produkJadi)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProdukJadi  $produkJadi
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ProdukJadi $produkJadi)
    {
        //
    }
}
