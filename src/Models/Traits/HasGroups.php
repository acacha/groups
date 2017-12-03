<?php

namespace Acacha\Groups\Models\Traits;

use Acacha\Groups\Models\Group;

/**
 * Trait HasGroups.
 *
 * @package Acacha\Groups\Models\Traits
 */
trait HasGroups
{
    /**
     * Get all groups for the model.
     */
    public function groups()
    {
        return $this->morphToMany(Group::class, 'groupable');
    }
}