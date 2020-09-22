<?php

namespace App\Policies;

use App\Category_child;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CateChildPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any category_children.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the category_child.
     *
     * @param  \App\User  $user
     * @param  \App\Category_child  $categoryChild
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->role==='Editor'||$user->role==='Normal';
    }

    /**
     * Determine whether the user can create category_children.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role==='Editor';
    }

    /**
     * Determine whether the user can update the category_child.
     *
     * @param  \App\User  $user
     * @param  \App\Category_child  $categoryChild
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->role==='Editor';
    }

    /**
     * Determine whether the user can delete the category_child.
     *
     * @param  \App\User  $user
     * @param  \App\Category_child  $categoryChild
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->role==='Editor';
    }

    /**
     * Determine whether the user can restore the category_child.
     *
     * @param  \App\User  $user
     * @param  \App\Category_child  $categoryChild
     * @return mixed
     */
    public function restore(User $user)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the category_child.
     *
     * @param  \App\User  $user
     * @param  \App\Category_child  $categoryChild
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        //
    }
}
