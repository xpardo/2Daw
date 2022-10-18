<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use Laravel\Sanctum\Sanctum;

class AuthTest extends TestCase
{
    const URI = 'api/auth';

    /**
     * Register (POST)
     *
     * @return void
     */
    public function test_register()
    {
        $name = 'test' . time();
        $data = [
            'name'      => $name,
            'email'     => $name . '@test.org',
            'password'  => '12345678',
            'role_id'   => 2
        ];

        $response = $this->postJson(self::URI . "/register", $data);
        
        $response
            ->assertStatus(200)
            ->assertJson([
                "access_token"  => true,
                "token_type"    => "Bearer"
            ]);

        return new User($data);
    }

    /**
     * Login (POST)
     * @param User
     * @return void
     * 
     * @depends test_register
     */
    public function test_login($user)
    {
        $response = $this->postJson(self::URI . "/login", [
            'email'     => $user->email,
            'password'  => $user->password,
        ]);
        $response
            ->assertStatus(200)
            ->assertJson([
                "access_token"  => true,
                "token_type"    => "Bearer"
            ]);
    }

    /**
     * User (GET)
     *
     * @return void
     * 
     * @depends test_register
     */
    public function test_user($id)
    {
        // No login
        $response = $this->getJson(self::URI . "/user");
        $response->assertStatus(401);

        // User logged
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->getJson(self::URI . "/user");
        $response
            ->assertStatus(200)
            ->assertJson([
                'id'        => true,
            ]);
    }
}