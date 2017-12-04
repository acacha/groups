<?php

namespace Tests\Feature;

use Acacha\Forge\Models\Group;
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
     * Groups manager can list groups.
     *
     * @test
     */
    public function groups_manager_can_list_groups()
    {
        $this->loginAsGroupsManager();

        factory(Group::class,3)->create();

        $response = $this->get('/api/v1/group');

        $response->assertSuccessful();

        $this->assertCount(3, json_decode($response->getContent()));

        $response->assertJsonStructure([[
            'id','name'
        ]]);
    }

    /**
     * Groups manager can show group.
     *
     * @test
     */
    public function groups_manager_can_show_group()
    {
        $this->loginAsGroupsManager();

        $group = factory(Group::class)->create();

        $response = $this->get('/api/v1/group/' . $group->id);

        $response->assertSuccessful();

        $response->assertJson([
            'id' => $group->id,
            'name' => $group->name
        ]);
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

    /**
     * Groups manager can update group.
     *
     * @test
     */
    public function groups_manager_can_edit_group()
    {
        $this->loginAsGroupsManager();

        $group = factory(Group::class)->create();

        $response = $this->put('/api/v1/group/' . $group->id, [
            'name' => 'Nou nom'
        ]);

        $response->assertSuccessful();

        $response->assertJson([
            'id' => $group->id,
            'name' => 'Nou nom'
        ]);

        $this->assertDatabaseHas('groups', [
            'id' => $group->id,
            'name' => 'Nou nom'
        ]);

        $this->assertDatabaseMissing('groups', [
            'id' => $group->id,
            'name' => $group->name
        ]);
    }

    /**
     * Groups manager can destroy group.
     *
     * @test
     */
    public function groups_manager_can_destroy_group()
    {
        $this->loginAsGroupsManager();

        $group = factory(Group::class)->create();

        $response = $this->delete('/api/v1/group/' . $group->id);

        $response->assertSuccessful();

        $response->assertJson([
            'id' => $group->id,
            'name' => $group->name
        ]);

        $this->assertDatabaseMissing('groups',[
            'id' => $group->id,
            'name' => $group->name
        ]);
    }
}
