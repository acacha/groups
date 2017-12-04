<?php

namespace Tests\Feature;

use Acacha\Groups\Models\Group;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class APIAuthorizedURLsTest.
 *
 * @package Tests\Feature
 */
class APIAuthorizedURLsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Set up tests.
     */
    public function setUp()
    {
        parent::setUp();
        $user = factory(User::class)->create();
        $group = factory(Group::class)->create();
        initialize_groups_management_permissions();
        $this->actingAs( $user,'api');
//        $this->withoutExceptionHandling();
    }

    /**
     * Authorizated URIs provider.
     *
     * @return array
     */
    public function authorizatedURIs()
    {
        return [
            ['get','/api/v1/group'],
            ['get','/api/v1/group/1'],
            ['post','/api/v1/group'],
            ['put','/api/v1/group/1'],
            ['delete','/api/v1/group/1'],

            ['post','/api/v1/group/1/user/1'],
        ];
    }

    /**
     * URI requires authorizated user.
     *
     * @test
     * @dataProvider authorizatedURIs
     */
    public function uri_requires_authorizated_user($method , $uri)
    {
        $response = $this->json($method, $uri);
        $response->assertStatus(403);
    }

}