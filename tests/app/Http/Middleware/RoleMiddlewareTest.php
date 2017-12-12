<?php

use App\Role;
use App\User;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class RoleMiddlewareTest extends TestCase
{
    //To keep DB clean
    use \Laravel\Lumen\Testing\DatabaseTransactions;
    public function setUp()
    {
        parent::setUp();
        $this->post('/login', [
            'username' => 'admin',
            'password' => 'admin',
        ], [ 'Debug-Token' => env('DEBUG_TOKEN')]);
    }

    public function testBadRole()
    {
        //before adding admin role
        $user = User::where('id', 2)->first();

        $this->actingAs($user)->get('/roles/1', ['Debug-Token' => env('DEBUG_TOKEN')]);
        $this->assertResponseStatus(401);
        $this->assertEquals('{"error":"Incorrect Role"}', $this->response->getContent());
    }

    public function testAssignRole()
    {
        $this->actingAs(Auth::user())->post('roles/assignRole/2/admin');

        $this->actingAs(Auth::user())->get('/roles/2');
        //Check to see if the role was assigned successfully
        $roles = json_decode($this->response->getContent());
        $this->assertEquals('admin', $roles[0]->name);
    }

    public function testRevokeRole()
    {
        $testUser = User::where('id', 2)->first();

        $this->actingAs(Auth::user())->post('roles/assignRole/2/admin'); //Add user_role

        $this->actingAs($testUser)
               ->get('/roles/2');

        $roles = json_decode($this->response->getContent());
        $this->assertEquals('admin', $roles[0]->name); // Ensure we added the role correctly

        $this->actingAs(Auth::user())->post('roles/revokeRole/2/admin'); //remove the role

        $this->actingAs($testUser)->get('/roles/2');
        $this->assertResponseStatus(401); //ensure we get access denied error
    }

    public function testCreateRole()
    {
        $this->actingAs(Auth::user())->post('/roles/createRole/intern');

        $this->actingAs(Auth::user())->post('/roles/assignRole/2/intern'); //Assign new role
        $this->actingAs(Auth::user())->get('/roles/2');
        $roles = json_decode($this->response->getContent());
        $this->assertEquals('intern', $roles[0]->name);

    }

    public function testDeleteRole()
    {
        $this->actingAs(Auth::user())->post('/roles/createRole/intern');
        $this->assertNotNull(Role::where('name', 'intern')->first());

        $this->actingAs(Auth::user())->post('/roles/deleteRole/intern');
        $this->assertNull(Role::where('name', 'intern')->first());

        $this->assertNotNull(Role::withTrashed()->where('name', 'intern')->first());
    }

    public function testInactiveRole()
    {
        $this->assertEquals(1, Role::where('name', 'admin')->first()->active);

        $this->actingAs(Auth::user())->get('/roles/3');
        $this->assertResponseStatus(200);

        $this->actingAs(Auth::user())->post('/roles/deactivate/admin');

        $this->actingAs(Auth::user())->get('/roles/3');
        $this->assertResponseStatus(401);
    }

    public function testActivateRole(){
        $this->actingAs(Auth::user())->post('/roles/createRole/intern');
        $this->actingAs(Auth::user())->post('/roles/assignRole/2/intern'); //Assign new role
        $this->actingAs(Auth::user())->get('/roles/2');
        $roles = json_decode($this->response->getContent());
        $this->assertEquals(1, $roles[0]->active);

        $this->actingAs(Auth::user())->post('/roles/deactivate/intern');

        $this->actingAs(Auth::user())->get('roles/2');
        $roles = json_decode($this->response->getContent());
        $this->assertEquals(0, $roles[0]->active);
    }

//    public function testEmptyRoles()
//    {
//
//    }
//
//    public function testMultipleRoles()
//    {
//
//    }
//
//    public function testIncorrectRole(){
//
//    }

}