<?php

namespace Acacha\Groups\Http\Controllers;

use Acacha\Groups\Http\Requests\StoreUserGroup;
use Acacha\Groups\Models\Group;
use App\User;

/**
 * Class APIUserGroupController.
 *
 * @package Acacha\Groups\Http\Controllers
 */
class APIUserGroupController
{
    /**
     * Assign user to group.
     */
    public function store(StoreUserGroup $request, Group $group, User $user)
    {
        $user->groups()->save($group);
    }
}