<?php

namespace App\Policies\Dashboard\PageSettings\PageHeader;

use App\Models\Page\PageHeader;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PageHeaderPolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Page\PageHeader  $pageHeader
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, PageHeader $pageHeader)
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
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Page\PageHeader  $pageHeader
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, PageHeader $pageHeader)
    {
        return $user->id === $pageHeader->page->owner_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Page\PageHeader  $pageHeader
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, PageHeader $pageHeader)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Page\PageHeader  $pageHeader
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, PageHeader $pageHeader)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Page\PageHeader  $pageHeader
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, PageHeader $pageHeader)
    {
        //
    }
}
