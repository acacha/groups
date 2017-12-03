<?php

namespace Tests\Feature;

use Acacha\Groups\Models\Group;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class APIUserGroupsControllerTest.
 *
 * @package Acacha\Groups
 */
class APIUserGroupsControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Set up tests.
     */
    public function setUp()
    {
        parent::setUp();
        initialize_groups_management_permissions();
        $this->withoutExceptionHandling();

    }

    /**
     * Login as groups manager.
     *
     */
    protected function loginAsGroupsManager()
    {
        $user = factory(User::class)->create();
        $user->assignRole('groups-manager');
        $this->actingAs($user,'api');
    }

    /**
     * Groups manager can add user to group.
     *
     * @test
     */
    public function groups_manager_can_add_user_to_group()
    {
        $this->loginAsGroupsManager();
        $user = factory(User::class)->create();
        $group = factory(Group::class)->create();
        $response = $this->post('/api/v1/group/' . $group->id . '/user/' . $user->id);

        $response->assertSuccessful();

//        $response->dump();

        $this->assertDatabaseHas('groupables', [
            'group_id' => $group->id,
            'groupable_id' => $user->id,
            'groupable_type' => User::class,
        ]);

    }
}
