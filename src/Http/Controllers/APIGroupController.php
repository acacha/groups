<?php

namespace Acacha\Groups\Http\Controllers;

use Acacha\Groups\Http\Requests\DestroyGroup;
use Acacha\Groups\Http\Requests\ListGroups;
use Acacha\Groups\Http\Requests\ShowGroup;
use Acacha\Groups\Http\Requests\StoreGroup;
use Acacha\Groups\Http\Requests\UpdateGroup;
use Acacha\Groups\Models\Group;

/**
 * Class APIGroupController.
 *
 * @package Acacha\Groups\Http\Controllers
 */
class APIGroupController
{
    /**
     * List groups.
     *
     * @param ListGroups $request
     * @return mixed
     */
    public function index(ListGroups $request)
    {
        return Group::all();
    }

    /**
     * Show group.
     *
     * @param ShowGroup $request
     * @return mixed
     */
    public function show(ShowGroup $request, Group $group)
    {
        return $group;
    }

    /**
     * Store group.
     *
     * @param StoreGroup $request
     * @return mixed
     */
    public function store(StoreGroup $request)
    {
        return Group::create($request->only(['name']));
    }

    /**
     * Update group.
     *
     * @param UpdateGroup $request
     * @return mixed
     */
    public function update(UpdateGroup $request, Group $group)
    {
        $group->update($request->only('name'));
        $group->save();
        return $group;
    }

    /**
     * Destroy group.
     *
     * @param DestroyGroup $request
     * @return mixed
     */
    public function destroy(DestroyGroup $request, Group $group)
    {
        $group->delete();
        return $group;
    }
}