<?php

namespace App\Policies;

use App\Model\admin\admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view any models.
     *
     * @param  \App\Model\admin\admin  $user
     * @return mixed
     */
    public function viewAny(admin $user)
    {
        //
    }

    /**
     * Determine whether the admin can view the model.
     *
     * @param  \App\Model\admin\admin  $admin
     * @return mixed
     */
    public function view(admin $user)
    {
        //
    }

    /**
     * Determine whether the admin can create models.
     *
     * @param  \App\Model\admin\admin  $user
     * @return mixed
     */
    public function create(admin $user)
    {
        foreach ($user -> roles as $role) {
            foreach ($role -> permissions as $permission) {
                if ($permission -> id == 4) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Determine whether the admin can update the model.
     *
     * @param  \App\Model\admin\admin  $user
     * @return mixed
     */
    public function update(admin $user)
    {
        foreach ($user -> roles as $role) {
            foreach ($role -> permissions as $permission) {
                if ($permission -> id == 4) {
                    return true;
                }
            }
        }
    }

    /**
     * Determine whether the admin can delete the model.
     *
     * @param  \App\Model\admin\admin  $user
     * @return mixed
     */
    public function delete(admin $user)
    {
        //
    }

    /**
     * Determine whether the admin can restore the model.
     *
     * @param  \App\Model\admin\admin  $user
     * @return mixed
     */
    public function restore(admin $user)
    {
        //
    }

    /**
     * Determine whether the admin can permanently delete the model.
     *
     * @param  \App\Model\admin\admin  $user
     * @return mixed
     */
    public function forceDelete(admin $user)
    {
        //
    }
}
