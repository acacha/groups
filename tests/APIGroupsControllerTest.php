<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class APIGroupsControllerTest.
 *
 * @package Acacha\Groups
 */
class APIGroupsControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Set up tests.
     */
    public function setUp()
    {
        parent::setUp();
        initialize_groups_management_permissions();
//        $this->withoutExceptionHandling();

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
     * Groups manager can create group.
     *
     * @test
     */
    public function groups_manager_can_create_group()
    {
        $this->loginAsGroupsManager();

        $response = $this->post('/api/v1/group', [
            'name' => 'Group1'
        ]);

        $response->assertSuccessful();

        $response->assertJson([
            'name' => 'Group1'
        ]);

        $this->assertDatabaseHas('groups', [
            'name' => 'Group1'
        ]);

    }
}
