<?php

namespace App\Policies;

use App\Models\Pub;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PubPolicy
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
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pub  $pub
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Pub $pub)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user, Pub $pub)
    {
        return ($user->id == $pub->author_id || $user->hasPermission('create_post'));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pub  $pub
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Pub $pub)
    {
        return ($user->id == $pub->author_id && $user->hasPermission('update_post'));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pub  $pub
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Pub $pub)
    {
        return ($user->id == $pub->author_id && $user->hasPermission('delete_post'));
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pub  $pub
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Pub $pub)
    {
        return ($user->id == $pub->author_id && $user->hasPermission('restore_post'));
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pub  $pub
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Pub $pub)
    {
        return ($user->id == $pub->author_id && $user->hasPermission('force_delete_post'));
    }
}
