<?php

namespace Acacha\Groups\Http\Controllers;

use Acacha\Groups\Http\Requests\StoreGroup;
use Acacha\Groups\Models\Group;

/**
 * Class APIGroupController.
 *
 * @package Acacha\Groups\Http\Controllers
 */
class APIGroupController
{
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
}