<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * feature test User API.
     *
     * @return void
     */
    public function test_register()
    {
        $response = $this->postJson('/api/register', ['name' => 'Dean', 'email' => 'dean02@gmail.com', 'password' => 'root18kar']);

        $response
            ->assertStatus(200)
            ->assertJson([
                'access_token' => true,
                'token_type' => "Bearer",
            ]);
    }

    public function test_login()
    {
        $response = $this->postJson('/api/login', ['email' => 'andean@gmail.com', 'password' => 'root18kar']);

        $response
            ->assertStatus(200)
            ->assertJson([
                'access_token' => true,
                'token_type' => "Bearer",
            ]);
    }

    public function test_get_user()
    {

        $response = $this->postJson('/api/login', ['email' => 'andean@gmail.com', 'password' => 'root18kar']);
        $token = $response->json('access_token');

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', '/api/user');

        $response->assertStatus(200)
            ->assertJson([
                "name" => "Andean",
                "email" => "andean@gmail.com",
            ]);;
    }
}
