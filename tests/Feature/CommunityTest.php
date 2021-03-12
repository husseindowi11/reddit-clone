<?php

namespace Tests\Feature;


use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommunityTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testListOfMyCommunities()
    {
        //create user
        $user = User::withCount('communities')->has('communities')->first();

        //login
        auth()->login($user);

        //load communities list
        $response = $this->get('/communities');
        $response->assertStatus(200);

        $this->assertEquals($user->communities_count, substr_count($response->getContent(),"community-item"));

    }

    public function testCreateCommunity(){
        $user = User::first();
        auth()->login($user);

        $response = $this->post('/communities', [
            'name' => 'some name 21345',
            'description' => 'some desc 54678'
        ]);

        $response->assertStatus(302);

        $response = $this->get('/communities');
        $response->assertStatus(200);

        $this->assertStringContainsString('some name 21345', $response->getContent());
    }
}
