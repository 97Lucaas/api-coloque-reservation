<?php

namespace App\Policies;

use App\Models\Invitation;
use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvitationPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     *
     * @param  \App\Models\User  $user
     * @param  string  $ability
     * @return void|bool
     */
    // public function before(User $user, $ability)
    // {
    //     if ($user->isAdmin()) {
    //         return true;
    //     }
    // }


    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->isModo();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Invitation $invitation)
    {
        return $user->isModo();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(?User $user, Event $event)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Invitation $invitation)
    {
        return $user->isModo();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Invitation $invitation)
    {
        return $user->isModo();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Invitation $invitation)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Invitation $invitation)
    {
        //
    }
}
